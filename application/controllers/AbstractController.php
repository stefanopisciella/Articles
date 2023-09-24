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

    /*
    PAREMETERS    
        context: gives information about what kind of items are supposed to be paginated
        items: are all the items to be paginated
        html_page: is the html page that will be divided in pages
    */
    public static function definePagination($context, $number_of_items, $url_to_html_page){
        if($context == "articles") {
            $max_num_of_items_for_page = $GLOBALS['max_num_of_articles_for_page'];
        }

        $num_pages_needed = $number_of_items / $max_num_of_items_for_page;
        if($number_of_items % $max_num_of_items_for_page != 0) {
            // the last page will contain a number of items different to max_num_of_items_for_page
            $num_pages_needed += 1;
        } 

        AbastractController::addPagesButtons($url_to_html_page, $num_pages_needed);
    }

    public static function addPagesButtons($url_to_html_page, $num_pages){
        $page_buttons = "";
        for($i=1;$i<=$num_pages;$i++) {
            $url_to_html_page = "?page=" . $i; 
            $page_buttons .= '<li><a href="' . $url_to_html_page . '">' . $i .'</a></li>';
        }
        $GLOBALS['f3']->set('page_buttons', $page_buttons);
    }






}