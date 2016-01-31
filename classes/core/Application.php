<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 17.01.16
 * Time: 15:43
 */

namespace core;


use Notoj\Notoj;

abstract class Application
{

    public static function init() {
        ErrorHandler::init();
        //Notoj::enableCache("cache/test.php");
    }


}