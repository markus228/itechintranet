<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 08.01.16
 * Time: 10:21
 */

namespace controller;


use controller\Controller;
use view\BootstrapView;
use view\DashboardContentView;

class FilesController extends Controller
{

    /**
     * @return BootstrapView
     * @AuthReqiured
     */
    public function defaultAction()
    {

        $content = new DashboardContentView();

        $content->setTitle("Privat-Laufwerk");

        return BootstrapView::getDashboard("Privat-Laufwerk", $content, $this->router);
    }

    public function unsupportedAction()
    {
        AuthController::class;
    }
}