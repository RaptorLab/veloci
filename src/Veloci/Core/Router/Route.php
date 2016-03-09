<?php

namespace Veloci\Core\Router;

class Route
{
    /**
     * @var HttpMethod
     */
    private $method;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $controllerClass;

    /**
     * @var string
     */
    private $controllerMethod;

    /**
     * Route constructor.
     *
     * @param string $method
     * @param string $url
     * @param string $controllerClass
     * @param string $controllerMethod
     */
    public function __construct($method, $url, $controllerClass, $controllerMethod)
    {
        $this->method           = $method;
        $this->url              = $url;
        $this->controllerClass  = $controllerClass;
        $this->controllerMethod = $controllerMethod;
    }

    /**
     * @return HttpMethod
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getControllerClass()
    {
        return $this->controllerClass;
    }

    /**
     * @return string
     */
    public function getControllerMethod()
    {
        return $this->controllerMethod;
    }

    /**
     * @param string $url
     * @param string $controllerClass
     * @param string $controllerMethod
     * @return Route
     */
    public static function get($url, $controllerClass, $controllerMethod)
    {
        return new Route(HttpMethod::GET, $url, $controllerClass, $controllerMethod);
    }

    /**
     * @param string $url
     * @param string $controllerClass
     * @param string $controllerMethod
     * @return Route
     */
    public static function post($url, $controllerClass, $controllerMethod)
    {
        return new Route(HttpMethod::POST, $url, $controllerClass, $controllerMethod);
    }

    /**
     * @param string $url
     * @param string $controllerClass
     * @param string $controllerMethod
     * @return Route
     */
    public static function put($url, $controllerClass, $controllerMethod)
    {
        return new Route(HttpMethod::PUT, $url, $controllerClass, $controllerMethod);
    }

    /**
     * @param string $url
     * @param string $controllerClass
     * @param string $controllerMethod
     * @return Route
     */
    public static function delete($url, $controllerClass, $controllerMethod)
    {
        return new Route(HttpMethod::DELETE, $url, $controllerClass, $controllerMethod);
    }
}