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

        // get previous output buffering (for debug toolbar), only needed because php include will output content right away
        $ob_content = ob_get_contents();
        ob_clean();

        extract($context);
        try {
            $include_status = include $template;
        } catch (ErrorException $e) {
            throw new Nphp_TemplateMissingException("Template '{$template}' was not found.");
        }
        // get template output
        $ob_template_content = ob_get_contents();
        ob_clean();

        // add content to response
        $response = $this->request->response;
        $response->content = $ob_template_content;

        // output previous content back to output buffer
        echo $ob_content;

        return $response;

    }

    /**
     * Redirects controller to new url
     * @param string $url
     */
    protected function redirect($url) {

        return new Nphp_ResponseRedirect($url);

    }

}
