<?php

namespace App\Core;

abstract class Controller {
    protected $view;
    protected $model;

    public function __construct() {
        $this->view = new View();
    }

    protected function getParam($key, $default = null) {
        return $_GET[$key] ?? $_POST[$key] ?? $default;
    }
}