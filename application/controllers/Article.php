<?php
namespace controllers;

require "application/controllers/AbstractController.php";
use models\Article as ModelArticle;

use function PHPSTORM_META\sql_injection_subst;

class Article extends AbastractController{

    /*
    public static function add() {
        // removing templating tags from the form template
        $GLOBALS['f3']->set('article_title', ''); 
        $GLOBALS['f3']->set('article_content', '');
        
        echo $GLOBALS['view']->render('application/views/form.html');

        $article_title = $GLOBALS['f3']->get('POST.title');
        $article_content = $GLOBALS['f3']->get('POST.content');

        $article = array(
            1 => $article_title,
            2 => $article_content
        );

        ModelArticle::add($article); 
    } */

    /*
    public static function edit() {
        $article_id = $GLOBALS['f3']->get('PARAMS.id');

        $old_article =  ModelArticle::getById($article_id); 
        
        $GLOBALS['f3']->set('article_title', $old_article[0]['title']);
        $GLOBALS['f3']->set('article_content', $old_article[0]['content']);

        echo $GLOBALS['view']->render('application/views/form.html');
    } */

    /*
    public static function view() {
        if($GLOBALS['f3']->exists('GET.id')) {
            // client requested with a GET method the UPDATE of the article 
            $article_id = $GLOBALS['f3']->get('GET.id'); // i should check wether the $article_id contains an integer

            $old_article =  ModelArticle::getById($article_id); 
                
            $GLOBALS['f3']->set('article_title', $old_article[0]['title']);
            $GLOBALS['f3']->set('article_content', $old_article[0]['content']);

            echo $GLOBALS['view']->render('application/views/form.html'); 

            if($GLOBALS['f3']->exists('POST.title') && $GLOBALS['f3']->exists('POST.content')) {
                // client requested with a POST method the UPDATE of the article 
                $new_title = $GLOBALS['f3']->get('POST.title');
                $new_content = $GLOBALS['f3']->get('POST.content');

                $edited_article = array(
                    1 => $new_title,
                    2 => $new_content
                );

                ModelArticle::edit($edited_article, $article_id); 

                $GLOBALS['f3']->reroute('/article');
            }

        } else {
            // client requested with a GET method the CREATION of the article 
                
            // removing templating tags from the form template
            $GLOBALS['f3']->set('article_title', ''); 
            $GLOBALS['f3']->set('article_content', '');
        
            echo $GLOBALS['view']->render('application/views/form.html');

            if($GLOBALS['f3']->exists('POST.title') && $GLOBALS['f3']->exists('POST.content')) {
                // client requested with a POST method the CREATION of the article 
                $article_title = $GLOBALS['f3']->get('POST.title');
                $article_content = $GLOBALS['f3']->get('POST.content');
            
                $article = array(
                    1 => $article_title,
                    2 => $article_content
                );
            
                ModelArticle::add($article); 

                $GLOBALS['f3']->reroute('/article');
            }
        }
    } */

    public static function view() {
        if($GLOBALS['f3']->exists('PARAMS.id')) {
            // client requested with a GET method the UPDATE of the article 
            $article_id = $GLOBALS['f3']->get('PARAMS.id'); // i should check wether the $article_id contains an integer

            $old_article =  ModelArticle::getById($article_id); 
                
            $GLOBALS['f3']->set('article_title', $old_article[0]['title']);
            $GLOBALS['f3']->set('article_content', $old_article[0]['content']); 
            
            $GLOBALS['f3']->set('form_action', $GLOBALS['url_prefix'] . "article/save/" . $article_id); 

            echo parent::render('application/views/form.html');

        } else {
            // client requested with a GET method the CREATION of the article 
                
            // removing templating tags from the form template
            $GLOBALS['f3']->set('article_title', ''); 
            $GLOBALS['f3']->set('article_content', '');
            
            $GLOBALS['f3']->set('form_action', $GLOBALS['url_prefix'] . "article/save/"); 

            echo parent::render('application/views/form.html');
        }
    }

    public static function save() {
        if($GLOBALS['f3']->exists('POST.title') && $GLOBALS['f3']->exists('POST.content')) {
            // client requested with a POST method the UPDATE or the CREATION of the article 
            $article_title = $GLOBALS['f3']->get('POST.title');
            $article_content = $GLOBALS['f3']->get('POST.content');

            $article = array(
                1 => $article_title,
                2 => $article_content
            );

            $article_id = null;
            $article_id = $GLOBALS['f3']->get('PARAMS.id');
            
            ModelArticle::save($article, $article_id); 
            
            if($article_id == null) {
                // client requested with a POST method the CREATION of the article 
                $GLOBALS['f3']->reroute('/article?page=1&order=1&dir=1');
            } else {
                // client requested with a POST method the UPDATE of the article 
                $GLOBALS['f3']->reroute('/article/' . $article_id);
            }
        }
    }

    public static function remove() {
        $article_id = $GLOBALS['f3']->get('PARAMS.id');
        // i should check wether the $article_id contains an integer
        ModelArticle::remove($article_id); 

        $GLOBALS['f3']->reroute(parent::getPreviousPage()); // BUG = if the user delets an article A which is the
        // only present in its own page, after the removal of A, the user will be redirect to an empty page
    }

    public static function getById() {
        // i should check wether the $article_id contains an integer
        $article_id = $GLOBALS['f3']->get('PARAMS.id');
        $article = ModelArticle::getById($article_id); 
        
        $GLOBALS['f3']->set('article_title', $article[0]['title']);
        $GLOBALS['f3']->set('article_content', $article[0]['content']);

        $GLOBALS['f3']->set('previous_page', parent::getPreviousPage()); // BUG

        echo parent::render('application/views/article_detail.html');
    }

    public static function index() {
        if($GLOBALS['f3']->exists('GET.page')) {
            $current_page = $GLOBALS['f3']->get('GET.page');
        } else {
            $current_page = 1; // if the url doesn't contain the "page" parameter, by default, to the user will be showed the first page
        }
        
        // $order is relative to the currently requested page, it's not relative to the previously requested page
        if($GLOBALS['f3']->exists('GET.order')) {
            $order = $GLOBALS['f3']->get('GET.order'); // $order indicates the order of the articles of the current page 
        } else {
            // it considers the default order (it orders by the creation_datetime column of the DB table)
            $order = 1; 
        }

        // $dir is relative to the currently requested page, it's not relative to the previously requested page
        if($GLOBALS['f3']->exists('GET.dir')) {
            $dir = $GLOBALS['f3']->get('GET.dir');
        } else {
            // it considers the default direction DESC
            $dir = 1;  
        }

        Article::setTheDirectionOfArticlesOrder($order, $dir);
        
        // defines the pagination
        $total_num_of_articles = ModelArticle::getNumOfArticles();
        parent::definePagination($GLOBALS['max_num_of_articles_for_page'], $total_num_of_articles , $GLOBALS['url_prefix'] . "article", $current_page, $order, $dir);
        
        $articles = ModelArticle::index($current_page, $GLOBALS['max_num_of_articles_for_page'], $order, $dir); 
        
        Article::injectArticlesIntoCurrentPage($articles);
    }

    public static function injectArticlesIntoCurrentPage($articles) {
        $num_articles = sizeof($articles);
        if($num_articles > 0) {
            $table_rows= Array();
    
            for($i=0;$i<$num_articles;$i++) {
                $GLOBALS['f3']->set('article_id', $articles[$i]['ID']); // the id is also flashed to the "value" attribute of the Remove button
                $GLOBALS['f3']->set('article_title', $articles[$i]['title']);
                
                // format the datetime
                $creation_datetime = parent::formatDateTime($articles[$i]['creation_datetime']);
                $last_update_datetime = parent::formatDateTime($articles[$i]['last_update_datetime']);

                $GLOBALS['f3']->set('creation_datetime', $creation_datetime);
                $GLOBALS['f3']->set('last_update_datetime', $last_update_datetime);
                $table_row = $GLOBALS['view']->render('application/views/table_row.html'); // note that in this case i don't use "parent::render" because we don't have to flash the header
                array_push($table_rows, $table_row);
            }
            $GLOBALS['f3']->set('table_rows', $table_rows);
            
            echo parent::render('application/views/articles.html');
        } else{
            echo 'No available articles';
        }
    }

    public static function setTheDirectionOfArticlesOrder($order, $dir) {
        // order = 1 means that it orders by the the creation_datetime column of the DB table
        // order = 2 means that it orders by the the last_update_datetime column of the DB table
        // dir = 1 is DESC
        // dir = 2 is ASC
        
        if($order == 1) {
            if($dir == 1) {
                $GLOBALS['f3']->set('order1_dir', 2); // switch the DIR

                $GLOBALS['f3']->set('direction_arrow_order1', '&darr;'); // ⬇️
            } else if ($dir == 2) {
                $GLOBALS['f3']->set('order1_dir', 1); // switch the DIR

                $GLOBALS['f3']->set('direction_arrow_order1', '&uarr;'); // ⬆️
            }
            
            $GLOBALS['f3']->set('order2_dir', 1);

            $GLOBALS['f3']->set('direction_arrow_order2', '');
        } else if ($order == 2) {
            if($dir == 1) {
                $GLOBALS['f3']->set('order2_dir', 2); // switch the DIR

                $GLOBALS['f3']->set('direction_arrow_order2', '&darr;'); // ⬇️
            } else if ($dir == 2) {
                $GLOBALS['f3']->set('order2_dir', 1); // switch the DIR

                $GLOBALS['f3']->set('direction_arrow_order2', '&uarr;'); // ⬆️
            }

            $GLOBALS['f3']->set('order1_dir', 1);

            $GLOBALS['f3']->set('direction_arrow_order1', '');
        } 
    }
} 


