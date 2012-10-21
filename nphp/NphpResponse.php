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
 * Default response class that is used if only string is returned from controller method, can be extended to modify behaviour
 *
 */
class Nphp_Response {

    /**
     * Http status code
     * @var integer
     */
    public $code = 200;

    /**
     * List of strings, header is set for each one
     * @var array
     */
    public $headers = array("Content-type: text/html; charset=UTF-8");

    /**
     * Content to be displayed
     * @var string
     */
    public $content = "";

    /**
     * Array of current cookies, alias for $_COOKIE
     * @var array
     */
    public $cookies;

    /**
     * Array of new cookies to be set with this response
     * @var array
     */
    private $newCookies = array();

    /**
     * Constructor
     */
    public function __construct() {

        $this->cookies = $_COOKIE;

    }

    /**
     * Sets http status code for this response
     * @param integer $code http status code
     */
    public function setCode($code) {

        $this->code = $code;

    }

    /**
     * List of headers to be set for response
     * @param array $headers
     */
    public function setHeaders($headers) {

        $this->headers = $headers;

    }

    /**
     * Single header to be added to list of headers
     * @param string $header
     */
    public function addHeader($header) {

        $this->headers[] = $header;

    }

    /**
     * Sets content to be displayed on a page
     * @param string $content
     */
    public function setContent($content) {

        $this->content = $content;

    }

    /**
     * Helper for setting new cookies, they get stored to $newCookies array and then passed to setcookie() when response starts
     * @param string $name
     * @param string $value
     * @param int $expire
     * @param string $path
     * @param string $domain
     * @param bool $secure
     * @param bool $httponly
     */
    public function addCookie($name, $value = NULL, $expire = 0, $path = NULL, $domain = NULL, $secure = false, $httponly = false) {

        $cookie = array($name, $value, $expire, $path, $domain, $secure, $httponly);
        array_push($this->newCookies, $cookie);
        // add to array of current cookies so it can be accessed in the same request
        array_push($this->cookies, $cookie);

    }

    /**
     * Internal function, sets new cookies that were added with addCookie(), it's called when response starts
     */
    public function _setCookies() {

        foreach ($this->newCookies as $cookie) {
            call_user_func_array("setcookie", $cookie);
        }

    }

}
