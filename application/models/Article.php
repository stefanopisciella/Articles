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

    public static function index($current_page, $max_num_of_articles_for_page, $order, $dir) {
        if($order == 1) {
            // it orders by the the creation_datetime column 
            if($dir == 1) {
                // most recently created article first (this is the default order)
                $query = "SELECT * 
                          FROM article 
                          ORDER BY creation_datetime DESC
                          LIMIT ?, ?";
            } else if ($dir == 2) {
                // least recently created article first
                $query = "SELECT * 
                          FROM article 
                          ORDER BY creation_datetime ASC
                          LIMIT ?, ?";
            }
        } else if ($order == 2) {
            // it orders by the the last_update_datetime column 
            if($dir == 1) {
                // most recently updated article first
                $query = "SELECT * 
                          FROM article 
                          ORDER BY last_update_datetime DESC
                          LIMIT ?, ?";
            } else if ($dir == 2) {
                $query = "SELECT * 
                          FROM article 
                          ORDER BY last_update_datetime ASC
                          LIMIT ?, ?";
            }
        }
        
        $parameters = array(
            1 => ($current_page - 1) * $max_num_of_articles_for_page,
            2 => $max_num_of_articles_for_page
        );

        $articles = $GLOBALS['f3']->get('DB')->exec($query, $parameters);

        return $articles;
    }

    public static function getNumOfArticles() {
        $restult = $GLOBALS['f3']->get('DB')->exec('SELECT COUNT(ID) FROM article');
        $num_of_articles = $restult[0]['COUNT(ID)'];

        return $num_of_articles;
    }

    public static function search($keywords) {
        $keywords = trim($keywords);

        $keywords = explode(' ', $keywords); // now $keywords contains an array of strings

        $keywords_num = count($keywords);

        $query = "SELECT * FROM article
                  WHERE "; 

        for($i=0;$i<$keywords_num - 1;$i++) {
            $query .= "title LIKE '%{$keywords[$i]}%' && ";
        }
        $query .= "title LIKE '%{$keywords[$keywords_num - 1]}%'";

        // 
        echo $query; 

        $matched_articles = $GLOBALS['f3']->get('DB')->exec($query);

        return $matched_articles;
    }

}