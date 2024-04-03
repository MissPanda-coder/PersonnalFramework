<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;


$routes = new RouteCollection;
$routes->add('hello', new Route('/bonjour/{name}', [
    'name' => 'World',
'_controller' => [new App\Controller\GreetingController,'hello']
    ]));
$routes->add('bye', new Route('/bye',[
'_controller' => [new App\Controller\GreetingController,'bye'] 
]
));
$routes->add('/test/about', new Route('/a-propos',[
    '_controller' => [new App\Controller\PageController,'about']]));

return $routes;