<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 26.12.15
 * Time: 22:11
 */

namespace controller;


use view\BootstrapView;
use view\DashboardContentView;
use view\PersoenlicheStatusseiteView;

class AccountController extends Controller
{


    /**
     * @return BootstrapView
     * @AuthRequired
     */
    public function defaultAction()
    {
        //if (!$this->router->getSessionSegment()->get("authenticated")) $this->router->redirectTo("?controller=main");

        $view = new PersoenlicheStatusseiteView($this->router->getApplicationSession()->getUser());


        $dashboard_content = new DashboardContentView();
        $dashboard_content->setContent($view);
        $dashboard_content->setTitle("Persönliche Statusseite");


        return BootstrapView::getDashboard(MainController::$MAIN_TITLE." Persönliche Statusseite", $dashboard_content, $this->router);
    }


    /**
     * @return BootstrapView
     * @AuthRequired
     */
    public function unsupportedAction()
    {
        return $this->defaultAction();
    }
}