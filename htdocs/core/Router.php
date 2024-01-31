<?php
class Router {
    protected $routes = [];

    public function addRoute($method, $path, $callback) {
        $this->routes[$method][$path] = $callback;
    }

    public function matchRoute() {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = $_SERVER['REQUEST_URI'];
        echo "url: ".$url;

        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $routeUrl => $target) {
                echo $routeUrl."<br>";
                if (preg_match_all('/\{(\w+)(:[^}]+)?}/', trim($routeUrl,"/"), $matches)) {
                    $names = $matches[1];
                }
                $regex = "@^" . preg_replace_callback('/\{\w+(:([^}]+))?}/', fn($m) => isset($m[2]) ? "({$m[2]})" : '(\w+)', trim($routeUrl, "/")) . "$@";


                if (preg_match_all($regex, trim($url, '/'), $valueMatches)) {
                    for ($i = 1; $i < count($valueMatches); $i++) {
                        $values[] = $valueMatches[$i][0];
                    }
                    $routeParams = array_combine($names, $values);

                    call_user_func_array($target, $routeParams);
                    return;
                }
            }
        }
        throw new Exception('Route not found');
    }
}