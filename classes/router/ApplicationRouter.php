<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 10.01.16
 * Time: 23:56
 */

namespace router;


use controller\LoginController;
use session\ApplicationSession;
use router\Router;
use core\ApplicationRoot;
use Notoj\ReflectionClass;

class ApplicationRouter extends Router
{

    /**
     * @var ApplicationRoot
     */
    private $applicationRoot;
    private static $applicationBaseURL;


    public function __construct(RequestAnalyzer $requestAnalyzer) {
        parent::__construct($requestAnalyzer);
        $this->applicationRoot = new ApplicationRoot();

    }

    /**
     * @return string
     */
    public static function getApplicationBaseURL()
    {
        if (self::$applicationBaseURL == null) {
            self::$applicationBaseURL = dirname($_SERVER["SCRIPT_NAME"])."/";
        }
        return self::$applicationBaseURL;
    }



    /**
     * @return ApplicationRoot
     */
    public function getApplicationRoot()
    {
        return $this->applicationRoot;
    }

    /**
     * @return ApplicationSession
     */
    public function getApplicationSession()
    {
        if (!$this->getSessionSegment()->get("intranet") instanceof ApplicationSession) {
            $this->getSessionSegment()->set("intranet", new ApplicationSession());
        }
        return $this->getSessionSegment()->get("intranet");
    }


    protected function preRouting()
    {

    }

    protected function postRouting()
    {

    }

    protected function preReRouting()
    {

    }

    protected function postReRouting()
    {

    }

    protected function preRunController()
    {
        $annotations = $this->controller->getControllerAnnotationParser()->getAnnotationsForMethod($this->action);

        if ($annotations->has("AuthRequired")) {
            if (!$this->getApplicationSession()->isSessionActive()) {
                $this->reRouteTo("login", "prompt");
            }
        }

        if ($annotations->has("LogInNotPermitted")) {
            if ($this->getApplicationSession()->isSessionActive()) {
                $this->redirectTo("main");
            }
        }
    }
}