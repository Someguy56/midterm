<?php

//TUrn on error reporting
ini_set('display_errors', true);
error_reporting(E_ALL);

//Require autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base class
$f3 = Base::instance();

$f3->set("checks", ['This midterm is easy', 'I like midterms', 'Today is Monday']);

//define a default route
$f3->route('GET /', function ()
{
    echo '<h1>Midterm Survey</h1>';
    echo '<a href="survey">Take my Midterm Survey</a>';
});

$f3->route('GET /survey', function () {
    $view = new Template();
    echo $view->render('views/survey.html');
});

//Run fat-free
$f3->run();
?>