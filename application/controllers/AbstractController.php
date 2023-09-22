<?php
namespace controllers;
class AbastractController{

    public static function render($page_content){
        $page_content = $GLOBALS['view']->render($page_content);
        $GLOBALS['f3']->set('page_content', $page_content);
        return $GLOBALS['view']->render('application/layouts/layout.html');
    }

    public static function formatDateTime($datetime_str){
        if(is_null($datetime_str)) {
            // in this case we return so that DateTime will not take in input a null parameter (if DateTime takes in input a null parameter, it will rise an exception!)
            return NULL; 
        }

        $datetime = new \DateTime($datetime_str); // "\DateTime" because DateTime is located in the global namespace
        return $datetime->format('d/m/Y g:i A');
    }

    public static function getPreviousPage(){
        $previous_page = $GLOBALS['f3']->get('SERVER.HTTP_REFERER');
        
        if(!is_null($previous_page)) {
            return $previous_page;
        } else {
            return "/article"; // return to the home         
        }
    }
}