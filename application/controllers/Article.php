<?php
namespace controllers;

require "application/controllers/AbstractController.php";
use models\Article as ModelArticle;

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

            echo parent::render('application/views/form.html');

        } else {
            // client requested with a GET method the CREATION of the article 
                
            // removing templating tags from the form template
            $GLOBALS['f3']->set('article_title', ''); 
            $GLOBALS['f3']->set('article_content', '');
        
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

            $article_id = $GLOBALS['f3']->get('PARAMS.id');
            ModelArticle::save($article, $article_id); 
            
            if($article_id == null) {
                // client requested with a POST method the CREATION of the article 
                $GLOBALS['f3']->reroute('/article'); // it reroutes to the page 1 of articles
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

        $GLOBALS['f3']->reroute(parent::getPreviousPage());
    }

    public static function getById() {
        // i should check wether the $article_id contains an integer
        $article_id = $GLOBALS['f3']->get('PARAMS.id');
        $article = ModelArticle::getById($article_id); 
        
        $GLOBALS['f3']->set('article_title', $article[0]['title']);
        $GLOBALS['f3']->set('article_content', $article[0]['content']);

        echo parent::render('application/views/article_detail.html');
    }

    /*
    public static function indexOld() {
        $articles = ModelArticle::index(); 
        
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
    } */

    public static function index() {
        if($GLOBALS['f3']->exists('GET.page')) {
            $current_page = $GLOBALS['f3']->get('GET.page');
        } else {
            $current_page = 1; // if the url doesn't contain the "page" parameter, by default, to the user will be showed the first page
        }
        
        $articles = ModelArticle::index($current_page); 
        
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

    
} 


