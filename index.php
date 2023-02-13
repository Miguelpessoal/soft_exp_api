<?php
    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

    date_default_timezone_set("America/Sao_Paulo");

    include_once "classes/Autoload.php";
    new Autoload();
    
    $route = new Route();
    
    // Product Types
    $route->add('GET', '/product-types', 'ProductTypes::index', false);
    $route->add('GET', '/product-types/show/[PARAM]', 'ProductTypes::show', false);
    $route->add('POST', '/product-types', 'ProductTypes::store', false);
    $route->add('PUT', '/product-types/update/[PARAM]', 'ProductTypes::update', false);
    $route->add('DELETE', '/product-types/delete/[PARAM]', 'ProductTypes::delete', false);
    
    // Products
    $route->add('GET', '/products', 'Products::index', false);
    $route->add('GET', '/products/show/[PARAM]', 'Products::show', false);
    $route->add('POST', '/products', 'Products::store', false);
    $route->add('PUT', '/products/update/[PARAM]', 'Products::update', false);
    $route->add('DELETE', '/products/delete/[PARAM]', 'Products::delete', false);
    
    // Acquisitions
    $route->add('GET', '/acquisitions', 'Acquisitions::index', false);
    $route->add('GET', '/acquisitions/show/[PARAM]', 'Acquisitions::show', false);
    $route->add('POST', '/acquisitions', 'Acquisitions::store', false);
    $route->add('PUT', '/acquisitions/update/[PARAM]', 'Acquisitions::update', false);
    $route->add('DELETE', '/acquisitions/delete/[PARAM]', 'Acquisitions::delete', false);
    $route->goTo($_GET['path']);