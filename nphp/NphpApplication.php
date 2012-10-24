<?php

/*
 * This file is part of the nphp package.
*
* (c) Aleš Krištof <ales.kristof@gmail.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

/**
 * Main application object
 *
 * Create new one and call start() in your main (index.php) file. Extendending the class is preferred way to add functionality
 * (database connectivity, template loaders, caching, ...)
 *
 */
class Nphp_Application {

    /**
     * Map of regular expressions mapped to extended Nphp_ControllerAbstract classes
     * @var array
     */
    public $routes = array();

    /**
     * Request object
     * @var Nphp_Request
     */
    public $request;

    /**
     * Debugging, if true show all errors, otherwise custom handler and event log
     * @var boolean
     */
    public $debug = FALSE;

    /**
     * Prefix, if urls start with something else than only domain
     * @var string
     */
    public $prefix = NULL;

    /**
     * Content that is displayed when 404 error occurs
     *
     * Easily overriden or changed to custom template/content
     *
     * @var string
     */
    public $error404 = "404 error!";

    /**
     * Content that is displayed when error 500 occurs (server error)
     * @var string
     */
    public $error500 = "500 error!";

    /**
     * Debug toolbar is enabled by default when debug is TRUE, change this if needed
     * @var boolean
     */
    public $disableDebugToolbar = FALSE;

    /**
     * Unix time when request started, used to calculate load time
     * @var mixed
     */
    private $startRequestTime;

    /**
     * Constructor, starts session as it's usually the first thing executed
     */
    public function __construct() {

        // start timer
        $this->startRequestTime = microtime(TRUE);

        // start session
        session_start();

        // create request
        $this->request = new Nphp_Request();

        // add to current cookies list so it's accessible in first request
        $this->request->response->cookies['PHPSESSID'] = session_id();

    }

    /**
     * Set routes array for application
     *
     * Parsed regular expressions get passed to correct method in class as array
     *
     * @param array $routes map of regular expressions mapped to extended Nphp_ControllerAbstract classes
     */
    public function setRoutes($routes) {

        $this->routes = $routes;

    }

    /**
     * Set debug value
     *
     * @param boolean $debug
     */
    public function setDebug($debug) {

        $this->debug = $debug;

    }

    /**
     * Set this to prefix that urls start with if it's not domain only
     *
     * It has to start with slash and end without it!
     *
     * @param string $prefix
     */
    public function setPrefix($prefix) {

        $this->prefix = $prefix;

    }

    /**
     * Does additional boostrapping needed by applications
     * @param Nphp_Request $request constructed request object that can be used and manipulated
     */
    public function bootstrap($request) {

    }

    /**
     * Starts application
     *
     * It does (in this order): creates request object, calls bootstrap method of application if it exists,
     * creates correct class and calls appropriate method (get() for HTTP GET, post() for HTTP POST, etc.).
     * If method is not found it tries to call all().
     *
     */
    public function start() {

        // start output buffering (so content is not visible if there are errors)
        ob_start();

        // check settings
        if ($this->debug) {
            error_reporting(E_ALL | E_ERROR | E_STRICT | E_WARNING | E_PARSE | E_NOTICE);
            ini_set('display_errors', '1');
        }

        try {

            // call bootstrap
            $response = $this->bootstrap($this->request);
            if (!is_null($response)) {
                // if bootstrap returned something it's response so make controller use it too
                $this->request->response = $response;
            }

            // match url and create class from route
            $urls = array_keys($this->routes);
            $class = NULL;
            foreach ($urls as $url) {
                if ($this->prefix) {
                    if ($url[0] == '^') {
                        $match_url = substr($url, 1, strlen($url)-1);
                    }
                    $match_url = '/^' . str_replace('/', '\/', $this->prefix . $match_url) . '/';
                } else {
                    $match_url = '/' . str_replace('/', '\/', $url) . '/';
                }
                // always try matching url with and without slash at the end
                $len = strlen($match_url);
                if (substr($match_url, $len-4, 4) == "\/$/") {
                    // remove slash
                    $alt_match_url = substr($match_url, 0, strlen($match_url)-4) . "$/";
                } else {
                    // add slash
                    $alt_match_url = substr($match_url, 0, strlen($match_url)-2) . "\/$/";
                }
                if (preg_match($match_url, $this->request->url, $matches) || preg_match($alt_match_url, $this->request->url, $matches)) {
                    $class = $this->routes[$url];

                    // set args for request, remove 0 which is full match
                    unset($matches[0]);
                    $this->request->args = $matches;
                    break;
                }
            }

            // check if bootstrap returns redirect - don't run any controller
            if ($this->request->response instanceof Nphp_ResponseRedirect) {

                $response = $this->request->response;

                // set headers
                foreach ($response->headers as $header) {
                    header($header, TRUE, $response_obj->code);
                }
                // set cookies
                $response->_setCookies();
                // set response code
                $GLOBALS['http_response_code'] = $response->code;

                ob_end_clean();

                echo $response->content;

                return;

            }

            if (is_null($class)) {

                // route was not found (none of the urls matched current url, display $error404 content)
                $response = $this->error404;

            } else {

                // hook for autoloaders
                if (method_exists($this, "autoload")) {
                    $new_class = $this->autoload($class);
                    if ($new_class) {
                        $class = $new_class;
                    }
                }

                // call method
                $object = new $class($this, $this->request);
                $method = strtolower($this->request->method);

                if (method_exists($object, $method)) {
                    // method for HTTP method exists (get, post, delete, put, ...)
                    $response = call_user_func(array($object, strtolower($this->request->method)), $this->request);
                } else if (method_exists($object, 'all')) {
                    $response = call_user_func(array($object, 'all'), $this->request);
                } else {
                    if ($this->debug) {
                        throw new Nphp_ControllerException("{$class} is missing method function (get(), post(), ...) or all().");
                    } else {
                        $response = new Nphp_Response();
                        $response->content = $this->error500;
                        $response->code = 405; // HTTP: method not allowed
                    }
                }

            }

            // get or create response object
            if ($response instanceof Nphp_Response) {
                $response_obj = $response;
            } else {
                $response_obj = new Nphp_Response();
                $response_obj->content = $response;
            }
            // set headers
            foreach ($response_obj->headers as $header) {
                header($header, TRUE, $response_obj->code);
            }
            // set cookies
            $response_obj->_setCookies();
            // set response code
            $GLOBALS['http_response_code'] = $response_obj->code;

            // show debug toolbar or flush output buffer
            if ($this->debug && !$this->request->is_xhr) {
                if ($this->disableDebugToolbar) {
                    // output buffer if debug toolbar is disabled
                    ob_end_flush();
                } else {
                    // get buffer contents and disable buffering
                    $ob_content = ob_get_contents();
                    ob_end_clean();

                    // calculate end time
                    $endRequestTime = microtime(TRUE);
                    $requestTime = ($endRequestTime - $this->startRequestTime);
                    $requestTime = sprintf("total: <span title=\"%.10f sec\">%.3f ms</span>", $requestTime, $requestTime*1000);

                    // render toolbar page
                    ob_start();
                    include "NphpToolbarTemplate.php";
                    $toolbar_content = ob_get_contents();
                    ob_end_clean();

                    // add debug toolbar to output content (before </body> or at the end)
                    if (stripos($response_obj->content, "</body>") === FALSE) {
                        $response_obj->content = "{$response_obj->content}\n{$toolbar_content}";
                    } else {
                        $response_obj->content = str_ireplace("</body>", "\n{$toolbar_content}\n</body>", $response_obj->content);
                    }
                }
            } else {
                // debug is turned off, discard everything in output buffer
                ob_end_clean();
            }

            // display content
            echo $response_obj->content;

        } catch (Exception $e) {

            if ($this->debug) {
                // display internal error page

                $error_page = new Nphp_ErrorPage($this, $this->request);
                $response = $error_page->get($this->request, $e);
                echo $response->content;

            } else {
                // show error 500 page and log error if logging is set up

                echo $this->error500;

            }

        }

    }

}
