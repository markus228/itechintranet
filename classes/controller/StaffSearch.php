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
use view\StaffSearchView;

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
        $staffSearchView = new StaffSearchView();

        $content = new DashboardContentView();
        $content->setTitle("Personensuche");
        $content->setContent($staffSearchView);


        $bootstrap = BootstrapView::getDashboard("Personensuche", $content);
        $bootstrap->addAdditionalJScript("resources/js/staffSearch.js");

        return $bootstrap;
    }

    /**
     * @AuthRequired
     */
    public function searchAction() {
        $searchTerm = $this->router->getRequestAnalyzer()->getPostRequest()["search"];
        $results = $this->router->getApplicationRoot()->getUserDAO()->searchUser($searchTerm);

        echo "search";


    }

    public function allUsersAction() {
        $users = $this->router->getApplicationRoot()->getUserDAO()->getAllUsers();

        $user_array = array();

        foreach ($users as $value) {
            $user_array[] = $value->toArray();
        }

        return json_encode(array("data" => $user_array));

    }

    public function unsupportedAction()
    {
        // TODO: Implement unsupportedAction() method.
    }
}