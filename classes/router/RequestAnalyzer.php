<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 26.01.16
 * Time: 18:58
 */

namespace router;


class RequestAnalyzer implements ControllerAndActionProvider
{



    private $get_request;
    private $post_request;
    private $request_method;


    private $controllerName;
    private $actionName;


    public static $NAMESPACE_CONTROLLER = "controller";

    public function __construct($get_request, $post_request, $request_method) {
        $this->get_request = $get_request;
        $this->post_request = $post_request;
        $this->request_method = $request_method;
        $this->analyze();

    }

    /**
     * @return mixed
     */
    public function getGetRequest()
    {
        return $this->get_request;
    }

    /**
     * @return mixed
     */
    public function getPostRequest()
    {
        return $this->post_request;
    }

    /**
     * @return mixed
     */
    public function getRequestMethod()
    {
        return $this->request_method;
    }




    public static function sanitizeRouterInput($input) {
        return ucfirst(preg_replace("/[^a-zA-Z]+/", "", $input));
    }


    public static function prependNamespaceAndAppendAppendix($class) {
        $class = "\\".self::$NAMESPACE_CONTROLLER."\\".$class."Controller";
        return $class;
    }



    public static function appendActionMethodAppendix($method) {
        return $method."Action";
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    public static function getRedirectURL($controller, $action = "") {
        if (empty($controller)) {
            if (empty($action)) {
                return ApplicationRouter::getApplicationBaseURL();
            } else {
                throw new \Exception("Invalid Controller/Action!");
            }
        }
        return $controller."/".$action;
    }


    /**
     * Analysiert die Anfrage des Clients
     */
    private function analyze() {
        //Aus Query die Parameter bestimmen
        $controller = self::sanitizeRouterInput(isset($this->get_request["controller"])?$this->get_request["controller"]:"");
        $action = self::sanitizeRouterInput(isset($this->get_request["action"])?$this->get_request["action"]:"");

        //Namespace an Controller hängen und Action ergänzen.
        $controller = self::prependNamespaceAndAppendAppendix($controller);
        $action = self::appendActionMethodAppendix($action);

        //Prüfen ob Controller im Namespace existiert...
        if (!class_exists($controller) || $controller == "\\controller\\Controller") {
            $controller = self::prependNamespaceAndAppendAppendix("Unknown");
        }

        //Prüfen ob Action im gewählten Controller existiert...
        if (!method_exists($controller, $action) && $action != "Action") {
            $action = self::appendActionMethodAppendix("unsupported"); //Action exisitiert nicht
        } elseif ($action == "Action") {
            $action = self::appendActionMethodAppendix("default"); //Keine Action angegeben
        }

        $this->controllerName = $controller;
        $this->actionName = $action;

    }

}