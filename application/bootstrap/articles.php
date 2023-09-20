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

$f3->set('AUTOLOAD','application/;');
$f3->set('ESCAPE',FALSE);

// ROUTES
$f3->route('GET /article/remove/@id','controllers\Article->remove');
$f3->route('GET|POST /article/view','controllers\Article->view');
$f3->route('GET /article/@id', 'controllers\Article->getById');
$f3->route('GET /article','controllers\Article->index');

$f3->run(); // it matches routes against incoming URI


