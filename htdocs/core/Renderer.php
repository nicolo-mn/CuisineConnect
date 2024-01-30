<?php

class Renderer{
    public static function render($template) {
        $templateParams["nome"] = $template;
        require './view/base.php';
    }
}