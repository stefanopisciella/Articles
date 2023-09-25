<?php
// require 'vendor/autoload.php';
require 'vendor/autoload.php';
require 'application/utils/MyView.php';


// f3
$GLOBALS['f3'] = \Base::instance(); //we use a superglobsl because we don't  have f3 instance inside controller and models classes

// View
$GLOBALS['view']= new View();

// DB
$f3->set('DB', new DB\SQL(
    'mysql:host=localhost;port=3306;dbname=articles', "root"
));

// CONSTANTS
$hostname = $f3->get('SCHEME') . "://" . $f3->get('HOST') . '/';
$GLOBALS['url_prefix'] = $hostname . 'Articles/public/';
$GLOBALS['max_num_of_articles_for_page'] = 3;

$f3->set('AUTOLOAD','application/;');
$f3->set('ESCAPE',FALSE);

// ROUTES
$f3->route('GET /article/remove/@id','controllers\Article->remove');
$f3->route('GET /article/view/@id','controllers\Article->view'); // for showing the UPDATE article form
$f3->route('POST /article/save/@id','controllers\Article->save'); // for UPDATING an article
$f3->route('GET /article/view','controllers\Article->view'); // for showing the CREATE article form
$f3->route('POST /article/save','controllers\Article->save'); // for CREATING a new article
$f3->route('GET /article/@id', 'controllers\Article->getById');
$f3->route('GET /article','controllers\Article->index');

$f3->run(); // it matches routes against incoming URI


