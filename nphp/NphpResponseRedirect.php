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
 * Default response that does internal redirect (302)
 *
 */
class Nphp_ResponseRedirect extends Nphp_Response {

    public function __construct($url) {

        parent::__construct();
        $this->setCode(302);
        $this->addHeader("Location: {$url}");

    }

}
