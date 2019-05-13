<?php

session_start();
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

$f3->route('GET|POST /survey', function ($f3)
{
    if(!empty($_POST))
    {
        $name = $_POST['name'];
        $choices = $_POST['choices'];

        $f3->set('name', $name);
        $f3->set('choices', $choices);

        if(empty($name))
        {
            $f3->set("errors['name']", 'Please enter a name');
        }
        if(empty($choices))
        {
            $f3->set("errors['choices']", 'Please pick one option');
        }

        $_SESSION['name'] = $name;
        $_SESSION['choices'] = $choices;
        if(empty($f3->get("errors")))
        {
            $f3->reroute('/summary');
        }
    }

    $view = new Template();
    echo $view->render('views/survey.html');
});

$f3->route('GET|POST /summary', function () {
    $view = new Template();
    echo $view->render('views/summary.html');
});

//Run fat-free
$f3->run();
?>