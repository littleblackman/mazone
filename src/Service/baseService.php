<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Session\Session;


/**
 * Class baseSession
 * Add commons methods to all Services
 *
 * @package App\Domain\Service
 */
abstract class baseService
{

    protected $session;

    public function __construct() {

        $session = new Session();
        if($session->isStarted()) $session->start();
        $this->session = $session;
    }
}
