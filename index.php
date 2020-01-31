<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

//session start() wont work if there is space or any echo statement after php or before php
session_start();

require "vendor/autoload.php";

$f3 = Base::instance();

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

$f3->route('GET /order',function () {
    $view = new Template();//template object
    echo $view-> render('views/form1.html');//use it to render the main page
});

$f3->route('POST /order2',function ()
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