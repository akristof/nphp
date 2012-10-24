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
 * Error controller for missing pages (error 404)
 *
 */
class Nphp_Response500 extends Nphp_Response {

    public function __construct($content) {

        parent::__construct();
        $this->setCode(500);
        $this->setContent($content);

    }

}
