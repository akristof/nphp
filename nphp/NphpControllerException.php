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
 * Exception that is thrown when used controller doesn't have methods that can handle incoming request.
 *
 * For example: if browser makes HTTP request with method GET, resolved controller should have either get() or all() method.
 * If both of them are missing this exception is thrown
 *
 */
class Nphp_ControllerException extends Exception {



}