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
    public function __construct(string $method, string $url, string $controllerClass, string $controllerMethod)
    {
        $this->method           = $method;
        $this->url              = $url;
        $this->controllerClass  = $controllerClass;
        $this->controllerMethod = $controllerMethod;
    }

    /**
     * @see HttpMethod
     * @return string
     */
    public function getMethod():string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getUrl():string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getControllerClass():string
    {
        return $this->controllerClass;
    }

    /**
     * @return string
     */
    public function getControllerMethod():string
    {
        return $this->controllerMethod;
    }

    /**
     * @param string $url
     * @param string $controllerClass
     * @param string $controllerMethod
     * @return Route
     */
    public static function get($url, $controllerClass, $controllerMethod):Route
    {
        return new Route(HttpMethod::GET, $url, $controllerClass, $controllerMethod);
    }

    /**
     * @param string $url
     * @param string $controllerClass
     * @param string $controllerMethod
     * @return Route
     */
    public static function post($url, $controllerClass, $controllerMethod):Route
    {
        return new Route(HttpMethod::POST, $url, $controllerClass, $controllerMethod);
    }

    /**
     * @param string $url
     * @param string $controllerClass
     * @param string $controllerMethod
     * @return Route
     */
    public static function put($url, $controllerClass, $controllerMethod):Route
    {
        return new Route(HttpMethod::PUT, $url, $controllerClass, $controllerMethod);
    }

    /**
     * @param string $url
     * @param string $controllerClass
     * @param string $controllerMethod
     * @return Route
     */
    public static function delete($url, $controllerClass, $controllerMethod):Route
    {
        return new Route(HttpMethod::DELETE, $url, $controllerClass, $controllerMethod);
    }
}