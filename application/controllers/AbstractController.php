<?php
namespace controllers;
class AbastractController{

    public static function render($page_content){
        $page_content = $GLOBALS['view']->render($page_content);
        $GLOBALS['f3']->set('page_content', $page_content);
        return $GLOBALS['view']->render('application/layouts/layout.html');
    }

    public static function formatDateTime($datetime_str){
        $datetime = new \DateTime($datetime_str); // "\DateTime" because DateTime is located in the global namespace
        return $datetime->format('d/m/Y g:i A');
    }

}