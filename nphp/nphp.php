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
 * Transforms old style PHP errors into ErrorException, which is handled within application
 *
 * @param integer $errno
 * @param string $errstr
 * @param string $errfile
 * @param integer $errline
 * @throws ErrorException
 */
function php_error_handler($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

/**
 *
 */
set_error_handler("php_error_handler");

require_once("NphpApplication.php");
require_once("NphpControllerException.php");
require_once("NphpRequest.php");
require_once("NphpControllerAbstract.php");
require_once("NphpResponse.php");
require_once("NphpResponseRedirect.php");
require_once("NphpErrorPage.php");
