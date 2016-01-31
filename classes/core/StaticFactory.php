<?php

/**
 * Created by PhpStorm.
 * User: markus
 * Date: 28.12.15
 * Time: 16:58
 */

namespace core;

use Aura\Session\Session;
use Aura\Session\SessionFactory;

abstract class StaticFactory
{


    private static $Session;

    /**
     * Singleton für Session-Klasse
     * @return Session
     */
    static public function getSession() {
        //Singleton
        if(self::$Session instanceof Session) return self::$Session;
        $sessfactory = new SessionFactory();
        self::$Session = $sessfactory->newInstance($_COOKIE);
        return self::$Session;
    }



}