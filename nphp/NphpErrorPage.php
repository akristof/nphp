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
class Nphp_ErrorPage extends Nphp_ControllerAbstract {

    public function fullurl() {

        $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
        $protocol = substr(strtolower($_SERVER["SERVER_PROTOCOL"]), 0, strpos(strtolower($_SERVER["SERVER_PROTOCOL"]), "/")) . $s;
        $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
        return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];

    }

    public function get($request, $e) {

        // disable all previous output
        ob_end_clean();

        date_default_timezone_set('UTC');

        $vars = $e->getTrace();

        if (count($vars[0]["args"]) > 0) {
            $vars = $vars[0]["args"][4];
        } else {
            $vars = $vars[0]["args"];
        }

        //$request = $vars["request"];
        unset($vars["request"]);

        $context = array(
                "method" => $request->method,
                "url" => $this->fullurl(),
                "php" => phpversion(),
                "phpini" => ini_get_all(),
                "extensions" => get_loaded_extensions(),
                "type" => get_class($e),
                "message" => $e->getMessage(),
                "file" => $e->getFile(),
                "code" => $e->getCode(),
                "line" => $e->getLine(),
                "trace" => $e->getTrace(),
                "vars" => $vars,
                "request" => $request,
        );

        return $this->render("NphpErrorTemplate.php", $context);

    }

}
