<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;


class GreetingController{
public function hello(Request $request){
    $name = $request->attributes->get('name');

    //intégrer du HTML
    ob_start();
    include __DIR__ .'/pages/hello.php';
    //renvoyer la réponse
    return new Response(ob_get_clean());
}
}

$routes = new RouteCollection;
$routes->add('hello', new Route('/bonjour/{name}', [
    'name' => 'World',
'_controller' => [
    GreetingController::class,'hello']
    ]));
$routes->add('bye', new Route('/bye'));
$routes->add('/test/about', new Route('/a-propos'));

return $routes;