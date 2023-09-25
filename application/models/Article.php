<?php
namespace models;

class Article {
    /*
    public static function add($article) {
        $GLOBALS['f3']->get('DB')->exec(
            'INSERT INTO article (title, content) VALUES (?,?);',
            $article
        );
    }
    
    
    public static function edit($edited_article, $article_id) {
        array_push($edited_article, $article_id);
        
        $GLOBALS['f3']->get('DB')->exec(
            'UPDATE article a
             SET a.title = ?, a.content = ?
             WHERE a.ID = ?;',
            $edited_article
        );

        return $edited_article;
    }
    */

    public static function remove($article_id) {
        $GLOBALS['f3']->get('DB')->exec(
            'DELETE FROM article WHERE ID=?;',
            $article_id
        );
    }

    public static function save($article, $article_id) {
        if($article_id == null) {
            // CREATION of the article
            $GLOBALS['f3']->get('DB')->exec(
                'INSERT INTO article (title, content, creation_datetime, last_update_datetime) VALUES (?,?, NOW(), NOW());',
                $article
            );
        } else {
            // UPDATE of the article
            array_push($article, $article_id);
        
            $GLOBALS['f3']->get('DB')->exec(
                'UPDATE article
                 SET title = ?, content = ?, last_update_datetime = NOW()
                 WHERE ID = ?;',
                $article
            );
        }
    }

    public static function getById($article_id) {
        $article = $GLOBALS['f3']->get('DB')->exec(
            'SELECT * FROM article WHERE ID=?',
            $article_id
        );

        return $article;
    }

    /*
    public static function index() {
        $articles = $GLOBALS['f3']->get('DB')->exec('SELECT * FROM article');
        return $articles;
    } */

    public static function index($current_page, $max_num_of_articles_for_page) {
        $parameters = array(
            1 => ($current_page - 1) * $max_num_of_articles_for_page,
            2 => $max_num_of_articles_for_page
        );

        $articles = $GLOBALS['f3']->get('DB')->exec(
            'SELECT * 
            FROM article 
            LIMIT ?, ?;',
            $parameters
        );

        return $articles;
    }

    public static function getNumOfArticles() {
        $restult = $GLOBALS['f3']->get('DB')->exec('SELECT COUNT(ID) FROM article');
        $num_of_articles = $restult[0]['COUNT(ID)'];

        return $num_of_articles;
    }
}