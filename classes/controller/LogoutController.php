<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 31.01.16
 * Time: 15:34
 */

namespace controller;


class LogoutController extends Controller
{

    public function defaultAction()
    {
        $this->router->reRouteTo("login", "logout");
    }

    public function unsupportedAction()
    {
        // TODO: Implement unsupportedAction() method.
    }
}