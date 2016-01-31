<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 08.01.16
 * Time: 10:36
 */

namespace controller;


use controller\Controller;
use view\BootstrapView;
use view\DashboardContentView;

/**
 * Delivers StaffSearch Contents
 *
 * Class StaffSearchController
 * @package controller
 */
class StaffSearchController extends Controller
{

    /**
     * @return BootstrapView
     * @AuthRequired
     */
    public function defaultAction()
    {

        $content = new DashboardContentView();
        $content->setTitle("Personensuche");
        return BootstrapView::getDashboard("Personensuche", $content, $this->router);
    }

    /**
     * @AuthRequired
     */
    public function searchAction() {
        //$searchTerm = $this->router->getPostRequest()["search"];
        //$this->router->getApplicationRoot()->getUserDAO()->searchUser($searchTerm);

        echo "search";


    }

    public function unsupportedAction()
    {
        // TODO: Implement unsupportedAction() method.
    }
}