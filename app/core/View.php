<?php

namespace App\Core;

class View {
    private $data = [];
    private $layout = 'main';

    public function render($view, $data = []) {
        $this->data = $data;

        $viewPath = APP . "/views/{$view}.php";

        if (!file_exists($viewPath)) {
            throw new Exception("View file not found: {$viewPath}");
        }

        ob_start();
        extract($this->data);
        include $viewPath;
        $content = ob_get_clean();

        $layoutPath = APP . "/views/layout/{$this->layout}.php";
        if (file_exists($layoutPath)) {
            include $layoutPath;
        } else {
            echo $content;
        }
    }

    public function escape($string) {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

    public function formatPrice($price) {
        return number_format($price, 2, '.', ' ');
    }
}