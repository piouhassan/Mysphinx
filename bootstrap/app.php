<?php

require  __DIR__."/../vendor/autoload.php";


// Add Routing To the Project

$router = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $route) {

    // Web Router File Loading
    require __DIR__."/../routes/frontend/web.php";
    require __DIR__."/../routes/backend/web.php";

    // Rest Api Router File Loading
    require __DIR__ . "/../Api/route/api.php";
});


// Start Session @session_start()
$session = new \Akuren\Session\Session();

$session->set('mysphinx', "framework");

$harmony = new WoohooLabs\Harmony\Harmony(Zend\Diactoros\ServerRequestFactory::fromGlobals(), new Zend\Diactoros\Response());








