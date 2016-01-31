<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 16.01.16
 * Time: 13:54
 */

namespace controller;


use controller\Controller;
use Notoj\Notoj;
use Notoj\ReflectionClass;

class ControllerAnnotationParser
{
    /**
     * @var Controller
     */
    private $controller;
    private $method;

    /**
     * @var ReflectionClass
     */
    private $reflectionClass;


    public static function getFileNameForCache() {
        ;
    }


    public function __construct(Controller $controller) {
        $this->controller = $controller;
        $this->reflectionClass = new ReflectionClass($this->controller);

    }

    /**
     * @param $method
     * @return \Notoj\Annotation\Annotations
     * @throws \BadMethodCallException
     */
    public function getAnnotationsForMethod($method) {
        if (!$this->reflectionClass->hasMethod($method)) throw new \BadMethodCallException("Method not found!");
        return $this->reflectionClass->getMethod($method)->getAnnotations();
    }

    /**
     * @return array|\Notoj\Annotation\Annotations
     */
    public function getAnnotations() {
        return $this->reflectionClass->getAnnotations();
    }



}