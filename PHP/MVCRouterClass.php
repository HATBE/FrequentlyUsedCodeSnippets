<?php
    namespace app;

    class Router {
        private $url = [];
        private $controller = 'IndexController';
        private $method = 'index';
        private $params = [];

        public function __construct() {
            $this->getUrl();
            $this->getController();
            $this->setController();
            $this->getMethod();
            $this->getParams();
            $this->build();
        }

        private function getUrl() {
            if(isset($_SERVER['PATH_INFO'])) {
                $url = rtrim($_SERVER['PATH_INFO'], '/'); // remove last slash
                $url = substr($url, 1); // remove first slash
                $url = filter_var($url, FILTER_SANITIZE_URL); // sanitize URL
                $url = explode('/', $url);
                $this->url = $url;
            }
        }

        private function getController() {
            if(isset($this->url[0])) {
                $controller = strtolower($this->url[0]);
                $controller = ucfirst($controller);
                $controller .= 'Controller';
                if(file_exists(__DIR__ . '/controllers/' . $controller . '.php')) {
                    $this->controller = $controller;
                    array_shift($this->url);
                }
            }
        }

        private function setController() {
            require_once(__DIR__ . '/controllers/' . $this->controller . '.php');
            $controller = 'app\\controllers\\' . $this->controller;
            $this->controller = new $controller();
        }

        private function getMethod() {
            if(isset($this->url[0])) {
                $method = strtolower($this->url[0]);
                if(method_exists($this->controller, $method)) {
                    $this->method = $method;
                    array_shift($this->url);
                }
            }
        }

        private function getParams() {
            $this->params = $this->url ? array_values($this->url) : [];
        }

        private function build() {
            call_user_func_array([$this->controller, $this->method], $this->params);
        }
    }
