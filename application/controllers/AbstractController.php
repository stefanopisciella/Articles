<?php
namespace controllers;
class AbastractController{

    public static function render($template_path){
        $header = $GLOBALS['view']->render('application/views/header.html');
        $GLOBALS['f3']->set('header', $header);
        return $GLOBALS['view']->render($template_path);
    }
}