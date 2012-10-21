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
 * Extend this for each controller
 *
 * Suggestion: add render() method to render templates with your favourite templating engine
 *
 */
abstract class Nphp_ControllerAbstract {

    /**
     * Parent Nphp_Application
     * @var Nphp_Application
     */
    protected $_application;

    /**
     * Request object
     * @var Nphp_Request
     */
    public $request;

    /**
     * Constructor, gets parent Nphp_Application instance
     * @param Nphp_Application $application
     */
    public function __construct($application, $request) {

        $this->_application = $application;
        $this->request = $request;

    }

    /**
     * Renders template which is PHP file with variables from context associative array
     *
     * Override to use your favourite templating engine
     *
     * @param string $template PHP file
     * @param array $context associative array with variables
     * @return Nphp_Response
     */
    public function render($template, $context) {

        extract($context);
        $include_status = include $template;

        return $this->request->response;

    }

    /**
     * Redirects controller to new url
     * @param string $url
     */
    protected function redirect($url) {

        return new Nphp_ResponseRedirect($url);

    }

}
