<?php
    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

    date_default_timezone_set("America/Sao_Paulo");

    include_once "classes/Autoload.php";
    new Autoload();
    
    $route = new Route();
    
    // Product Types
    $route->add('GET', '/product_types', 'ProductTypes::index', false);
    $route->add('GET', '/product_types/show/[PARAM]', 'ProductTypes::show', false);
    $route->add('POST', '/product_types', 'ProductTypes::store', false);
    $route->add('PUT', '/product_types/update/[PARAM]', 'ProductTypes::update', false);
    $route->add('DELETE', '/product_types/delete/[PARAM]', 'ProductTypes::delete', false);
    $route->goTo($_GET['path']);