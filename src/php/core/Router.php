<?php

namespace php\core;

class Router {

  protected static $routes = [];
  protected static $route = [];

  /**
   * @param $regexp
   * @param array $route
   */
  public static function add($regexp, $route = []) {
    self::$routes[$regexp] = $route;
  }

  /**
   * @return array
   */
  public static function getRoute() {
    return self::$route;
  }

  /**
   * @return array
   */
  public static function getRoutes() {
    return self::$routes;
  }

  public static function dispatch($url) {
    if(self::matchRoute($url)) {
      $controller = 'php\classes\controllers\\' . self::$route['controller'] . 'Controller';
      if(class_exists($controller)) {
        $controllerObject = new $controller(self::$route);
        $action = self::lowerCamelCase(self::$route['action']) . 'Action';
        if(method_exists($controllerObject, $action)) {
          $controllerObject->$action();
          $controllerObject->getView();
        } else {
          throw new \Exception("Метод $controller::$action не найден", 404);
        }
      } else {
        throw new \Exception("Контроллер $controller не найден", 404);
      }
    } else {
      throw new \Exception('Страница не найдена', 404);
    }
  }

  public static function matchRoute($url) {
    foreach (self::$routes as $pattern => $route) {
      if(preg_match("#{$pattern}#", $url, $matches)) {
        foreach ($matches as $k => $v) {
          if(is_string($k)) {
            $route[$k] = $v;
          }
        }
        if(empty($route['action'])) {
          $route['action'] = 'index';
        }
        self::$route = $route;
        return true;
      }
    }
    return false;
  }

  protected static function upperCamelCase($name) {
    return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
  }

  protected static function lowerCamelCase($name) {
    return lcfirst(self::upperCamelCase($name));
  }
  
}