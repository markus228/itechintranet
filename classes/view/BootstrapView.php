<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 20.08.15
 * Time: 16:29
 */

namespace view;


use helpers\HTMLHelper;
use router\ApplicationRouter;
use view\architecture\View;


class BootstrapView extends View
{

    private $bodyContent;
    private $contentPastJS;
    private $css;
    private $title;
    private $additionalHeader;
    private $baseUrl;

    /**
     * @return mixed
     */
    public function getBaseUrl()
    {
        $this->setBaseUrl(ApplicationRouter::getApplicationBaseURL());
        return $this->baseUrl;
    }

    /**
     * @param mixed $baseUrl
     * @return BootstrapView
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdditionalHeader()
    {
        return $this->additionalHeader;
    }

    /**
     * @param mixed $additionalHeader
     * @return BootstrapView
     */
    public function setAdditionalHeader($additionalHeader)
    {
        $this->additionalHeader = $additionalHeader;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBodyContent()
    {
        return $this->bodyContent;
    }

    /**
     * @param mixed $bodyContent
     * @return BootstrapView
     */
    public function setBodyContent($bodyContent)
    {
        $this->bodyContent = $bodyContent;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContentPastJS()
    {
        return $this->contentPastJS;
    }

    /**
     * @param mixed $contentPastJS
     * @return BootstrapView
     */
    protected function setContentPastJS($contentPastJS)
    {
        $this->contentPastJS = $contentPastJS;
        return $this;
    }

    /**
     * @param $contentPastJS
     * @return $this
     */
    public function addContentPastJS($contentPastJS) {
        $this->contentPastJS.=$contentPastJS."\n";
        return $this;
    }

    /**
     * @param $path
     * @return BootstrapView
     */
    public function addAdditionalJScript($path) {
        return $this->addContentPastJS(HTMLHelper::scriptJS($path));
    }


    /**
     * @return mixed
     */
    public function getCss()
    {
        return $this->css;
    }

    /**
     * @param mixed $css
     * @return BootstrapView
     */
    public function setCss($css)
    {
        $this->css = $css;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return BootstrapView
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public static function getDashboard($title, DashboardContentView $dashboard_content) {
        $view = new BootstrapView();
        $view->setTitle($title);
        $view->setCss("dashboard.css");

        $view->setAdditionalHeader(
            HTMLHelper::linkCss("vendor/components/font-awesome/css/font-awesome.min.css")."\n".
            HTMLHelper::linkCss("vendor/datatables/datatables/media/css/dataTables.bootstrap.min.css")."\n".
            HTMLHelper::linkCss("vendor/components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css")."\n"
        );

        $view->setContentPastJS(
            HTMLHelper::scriptJS("resources/js/dashboard.js")."\n".
            HTMLHelper::scriptJS("vendor/datatables/datatables/media/js/jquery.dataTables.min.js")."\n".
            HTMLHelper::scriptJS("vendor/datatables/datatables/media/js/dataTables.bootstrap.min.js")."\n".
            HTMLHelper::scriptJS("vendor/components/bootstrap-switch/dist/js/bootstrap-switch.min.js")."\n".
            HTMLHelper::scriptJS("vendor/makeusabrew/bootbox/bootbox.js")."\n".
            HTMLHelper::scriptJS("vendor/rmm5t/jquery-timeago/jquery.timeago.js")
        );


        $dashboard = new DashboardView();

        $dashboard->setDashboardContent($dashboard_content);

        $nav_top = new NavigationTopView();

        $nav_top->setNavbarBrand("firma-Intranet");
        $dashboard->setNavigationTop($nav_top);
        $view->setBodyContent($dashboard);

        return $view;
    }

    public static function getLoginPage($title, LoginView $loginView) {
        $view = new BootstrapView();
        $view->setTitle($title);
        $view->setCss("login.css");
        $view->setBodyContent($loginView);

        $view->setAdditionalHeader(
            HTMLHelper::linkCss("vendor/components/font-awesome/css/font-awesome.min.css")."\n"
        );

        $view->setContentPastJS(
            HTMLHelper::scriptJS("resources/js/login.js")."\n"
        );

        return $view;



    }




}