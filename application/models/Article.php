<?php
namespace models;

class Article {
    public static function add($article) {
        $GLOBALS['f3']->get('DB')->exec(
            'INSERT INTO article (title, content) VALUES (?,?);',
            $article
        );
    }

    public static function remove($article_id) {
        $GLOBALS['f3']->get('DB')->exec(
            'DELETE FROM article WHERE ID=?;',
            $article_id
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

    public static function save($article, $article_id) {
        if($article_id == null) {
            // CREATION of the article
            $GLOBALS['f3']->get('DB')->exec(
                'INSERT INTO article (title, content) VALUES (?,?);',
                $article
            );
        } else {
            // UPDATE of the article
            array_push($article, $article_id);
        
            $GLOBALS['f3']->get('DB')->exec(
                'UPDATE article a
                 SET a.title = ?, a.content = ?
                 WHERE a.ID = ?;',
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

    public static function index() {
        $articles = $GLOBALS['f3']->get('DB')->exec('SELECT * FROM article');
        return $articles;
    }
}