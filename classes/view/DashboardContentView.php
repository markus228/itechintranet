<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 25.12.15
 * Time: 17:42
 */

namespace view;


use helpers\BootstrapAlert;
use view\architecture\View;

class DashboardContentView extends View
{
    private $title;
    private $subheading;
    private $alerts;
    private $footer;

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return DashboardContentView
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }
    private $content;

    /**
     * @return mixed
     */
    public function getFooter()
    {
        return $this->footer;
    }

    /**
     * @param mixed $footer
     * @return DashboardContentView
     */
    public function setFooter($footer)
    {
        $this->footer = $footer;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubheading()
    {
        return $this->subheading;
    }

    /**
     * @param mixed $subheading
     * @return DashboardContentView
     */
    public function setSubheading($subheading)
    {
        $this->subheading = $subheading;
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
     * @return DashboardContentView
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAlerts()
    {
        return $this->alerts;
    }

    /**
     * @param $message
     * @param BootstrapAlert $alertType
     * @return string
     */
    public function addAlert($message, BootstrapAlert $alertType) {
        return $this->alerts.=BootstrapAlert::getAlertBox($message, $alertType)."\n";
    }


}