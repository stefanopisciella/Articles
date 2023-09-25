 public static function view() {
        if($GLOBALS['f3']->exists('GET.id')) {
            // client requested with a GET method the UPDATE of the article 
            $article_id = $GLOBALS['f3']->get('GET.id'); // i should check wether the $article_id contains an integer

            $old_article =  ModelArticle::getById($article_id); 
                
            $GLOBALS['f3']->set('article_title', $old_article[0]['title']);
            $GLOBALS['f3']->set('article_content', $old_article[0]['content']);
            $GLOBALS['f3']->set('creation_datetime', $old_article[0]['creation_datetime']);
            $GLOBALS['f3']->set('last_update_datetime', $old_article[0]['last_update_datetime']);

            echo parent::render('application/views/form.html');
            
            Article::save($article_id);

            // $GLOBALS['f3']->reroute('/article/' . $article_id);

        } else {
            // client requested with a GET method the CREATION of the article 
                
            // removing templating tags from the form template
            $GLOBALS['f3']->set('article_title', ''); 
            $GLOBALS['f3']->set('article_content', '');
        
            echo parent::render('application/views/form.html');

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
