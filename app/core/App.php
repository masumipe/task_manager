<?php
// Main App class for routing
class App {
    protected $controller = 'HomeController'; // Set default to HomeController
    protected $method = 'index';
    protected $params = [];
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $url = $this->parseUrl();
        $controller = isset($url[0]) ? ucfirst($url[0]) . 'Controller' : $this->controller;
        $method = isset($url[1]) ? $url[1] : $this->method;
        if(isset($url[0]) && file_exists(__DIR__ . '/../controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }
        require_once __DIR__ . '/../controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;
        if(isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
    public function parseUrl() {
        if(isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}
