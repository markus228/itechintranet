<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 31.08.15
 * Time: 11:54
 */

namespace helpers;


class BootstrapAlert
{

    public static function SUCESSS() {
        return new BootstrapAlert("alert-success");
    }

    public static function INFO() {
        return new BootstrapAlert("alert-info");
    }

    public static function WARNING() {
        return new BootstrapAlert("alert-warning");
    }

    public static function DANGER() {
        return new BootstrapAlert("alert-danger");
    }

    private $string;

    private function __construct($string) {
        $this->string = $string;
    }

    public function toString() {
        return $this->string;
    }

    public function __toString() {
        return $this->toString();
    }


    public static function getAlertBox($message, BootstrapAlert $kind) {
        $buf =
            '<div class="alert '.$kind.' alert-dismissable">'."\n".
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'."\n".
            $message."\n".
            '</div>';

        return $buf;

    }


}

