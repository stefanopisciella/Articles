<?php
namespace controllers;

use models\Article as ModelArticle;

class Article {

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
        if($GLOBALS['f3']->exists('GET.id')) {
            // client requested with a GET method the UPDATE of the article 
            $article_id = $GLOBALS['f3']->get('GET.id'); // i should check wether the $article_id contains an integer

            $old_article =  ModelArticle::getById($article_id); 
                
            $GLOBALS['f3']->set('article_title', $old_article[0]['title']);
            $GLOBALS['f3']->set('article_content', $old_article[0]['content']);
            $GLOBALS['f3']->set('creation_datetime', $old_article[0]['creation_datetime']);
            $GLOBALS['f3']->set('last_update_datetime', $old_article[0]['last_update_datetime']);

            echo $GLOBALS['view']->render('application/views/form.html'); 
            
            Article::save($article_id);

            // $GLOBALS['f3']->reroute('/article/' . $article_id);

        } else {
            // client requested with a GET method the CREATION of the article 
                
            // removing templating tags from the form template
            $GLOBALS['f3']->set('article_title', ''); 
            $GLOBALS['f3']->set('article_content', '');
        
            echo $GLOBALS['view']->render('application/views/form.html');

            Article::save(""); // save() function takes in input "" as article ID 

            // $GLOBALS['f3']->reroute('/article');
        }
    }

    public static function save($article_id) {
        if($GLOBALS['f3']->exists('POST.title') && $GLOBALS['f3']->exists('POST.content')) {
            // client requested with a POST method the UPDATE or the CREATION of the article 
            $article_title = $GLOBALS['f3']->get('POST.title');
            $article_content = $GLOBALS['f3']->get('POST.content');

            $article = array(
                1 => $article_title,
                2 => $article_content
            );

            ModelArticle::save($article, $article_id); 
            $GLOBALS['f3']->reroute('/article/' . $article_id);
        }
    }

    public static function remove() {
        $article_id = $GLOBALS['f3']->get('PARAMS.id');
        // i should check wether the $article_id contains an integer
        ModelArticle::remove($article_id); 

        $GLOBALS['f3']->reroute('/article');
    }

    public static function getById() {
        // i should check wether the $article_id contains an integer
        $article_id = $GLOBALS['f3']->get('PARAMS.id');
        $article = ModelArticle::getById($article_id); 
        
        $GLOBALS['f3']->set('article_title', $article[0]['title']);
        $GLOBALS['f3']->set('article_content', $article[0]['content']);

        echo $GLOBALS['view']->render('application/views/article_detail.html');
    }

    public static function index() {
        $articles = ModelArticle::index(); 
        
        $num_articles = sizeof($articles);
        if($num_articles > 0) {
            $table_rows= Array();
    
            for($i=0;$i<$num_articles;$i++) {
                $GLOBALS['f3']->set('article_id', $articles[$i]['ID']); // the id is also flashed to the "value" attribute of the Remove button
                $GLOBALS['f3']->set('article_title', $articles[$i]['title']);
                $GLOBALS['f3']->set('creation_datetime', $articles[$i]['creation_datetime']);
                $GLOBALS['f3']->set('last_update_datetime', $articles[$i]['last_update_datetime']);
                $table_row = $GLOBALS['view']->render('application/views/table_row.html');
                array_push($table_rows, $table_row);
            }
            $GLOBALS['f3']->set('table_rows', $table_rows);
            echo $GLOBALS['view']->render('application/views/articles.html');
        } else{
            echo 'No available articles';
        }
    }

    
} 


