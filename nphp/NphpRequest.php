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
 * All request data in OOP form
 */
class Nphp_Request {

    /**
     * Current URL that was requested
     * @var string
     */
    public $url;

    /**
     * Http request method (GET, POST, ...)
     * @var string
     */
    public $method;

    /**
     * Default response object that will be used, can be overriden for more options
     * @var Nphp_Response
     */
    public $response;

    /**
     * Arguments from routing
     * @var array
     */
    public $args;

    /**
     * Array of current cookies, alias for $_COOKIE
     * @var array
     */
    public $cookies;

    /**
     * Array of uploaded files, alias for $_FILES
     * @var array
     */
    public $files;

    /**
     * Array of POST vars sent by request, alias for $_POST
     * @var array
     */
    public $post;

    /**
     * Array of GET vars sent by request, alias for $_GET
     * @var array
     */
    public $get;

    /**
     * Array of GET, POST and COOKIE vars, alias for $_REQUEST
     * @var array
     */
    public $request;

    /**
     * Constructor - fills all properties
     */
    public function __construct() {

        // get url, remove query string and fragment id (everything after ?)
        $split_url = explode('?', $_SERVER['REQUEST_URI'], 2);
        $this->url = $split_url[0];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->response = new Nphp_Response();
        $this->cookies = $_COOKIE;
        $this->files = $_FILES;
        $this->post = $_POST;
        $this->get = $_GET;
        $this->request = $_REQUEST;

    }

    /**
     * Getter for session property so it's always newest version of $_SESSION
     *
     * session is read-only, for setting use: setSessionValue(), getSessionValue(), removeSessionValue(), issetSessionValue()
     *
     * @param string $property name of the property
     * @return mixed
     */
    public function __get($property) {

        if ($property == 'session') {
            return $_SESSION;
        }
        throw new Exception("Nphp_Request doesn't have property \"{$property}\".");
        exit();

    }

    /**
     * Sets key with value in session
     * @param string $name
     * @param mixed $value
     */
    public function setSessionValue($name, $value) {

        $_SESSION[$name] = $value;

    }

    /**
     * Gets value of key from session
     * @param string $name
     * @return mixed
     */
    public function getSessionValue($name) {

        if (key_exists($name, $_SESSION)) {
            return $_SESSION[$name];
        } else {
            return NULL;
        }

    }

    /**
     * Removes key from session
     * @param string $name
     */
    public function removeSessionValue($name) {

        unset($_SESSION[$name]);

    }

    /**
     * Checks if key exists in session
     * @param strine $name
     * @return bool
     */
    public function issetSessionValue($name) {

        return key_exists($name, $_SESSION);

    }

    /**
     * Adds flash message to current session
     * @param string $message
     */
    public function addMessage($message) {

        $_SESSION['messages'][] = $message;

    }

    /**
     * Gets all flash messages for current session and deletes them (one-read)
     * @return array
     */
    public function getMessages() {

        if (isset($_SESSION['messages'])) {
            $messages = $_SESSION['messages'];
            unset($_SESSION['messages']);
            return $messages;
        } else {
            return array();
        }

    }

}
