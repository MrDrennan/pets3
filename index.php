<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

//session start() wont work if there is space or any echo statement after php or before php
session_start();

require "vendor/autoload.php";
require_once ('model/validation-functions.php');
$f3 = Base::instance();
$f3->set('DEBUG', 3);
$f3->set('colors', array('pink', 'green', 'blue'));


$f3->route('GET /',function ()
{
//    $view = new Template();//template object
//    echo $view-> render('views/home.html');//use it to render the main page
    echo "<h1>My pets </h1>";
    echo"<a href='order'>Order a pet</a>";

});

$f3->route('GET /@item', function($f3, $params) {
    $animal = $params['item'];

    if ($animal == 'chicken') {
        echo 'Cluck!';
    }
    else if ($animal == 'dog') {
        echo 'Woof!';
    }
    else if ($animal == 'cat') {
        echo 'Meow!';
    }
    else if ($animal == 'cow') {
        echo 'Moo!';
    }
    else if ($animal == 'donkey') {
        echo 'Hee Haw!';
    }
    else {
        $f3->error(404);
    }


});

$f3->route('GET|POST /order',function ($f3){
    $_SESSION = [];
    session_destroy();
    if(isset($_POST['animal'])) {
        $animal = $_POST['animal'];
        if(validText($animal)) {
            $_SESSION['animal'] = $animal;
            $f3->reroute('/order2.html');
        }
        else {
            $f3->set("errors['animal']", "Please enter an animal");
        }
    }
    $view = new Template();//template object
    echo $view-> render('views/form1.html');
    //use it to render the main page
});

$f3->route('GET|POST /order2',function ()
{
    $_SESSION['animal'] = $_POST['animal'];
    $view = new Template();//template object
    echo $view-> render('views/form2.html');//use it to render the main page

});

$f3->route('POST /results',function ()
{
    $_SESSION['color'] = $_POST['color'];
    $view = new Template();//template object
    echo $view-> render('views/results.html');//use it to render the main page

});

$f3->run();