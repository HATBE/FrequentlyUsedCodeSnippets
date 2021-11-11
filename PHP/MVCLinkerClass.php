<?php
    class Linker {
        public static function link(string $controller, string $method, array $args = []) {
            $link = ROOT_PATH . $controller . '/' . $method;
            $link .= '/' . join('/', $args);
            return $link;
        }

        public static function header(string $controller, string $method, array $args = []) {
            $link = Linker::link($controller, $method, $args);
            header('Location: ' . $link);
        }
    }