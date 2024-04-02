<?php

// pour démarrer le serveur dans le terminal php -S localhost:3000 -t public
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Exception\Exception;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;

require __DIR__ . '/../vendor/autoload.php';


$request = Request::createFromGlobals();

$routes = require __DIR__ . '/../src/routes.php';

$context = new RequestContext();
$context->fromRequest($request);

$urlMatcher = new UrlMatcher($routes, $context);

$pathInfo = $request->getPathInfo();
try{
    $resultat = $urlMatcher->match($pathInfo);
    $request ->attributes->add($resultat);
    $response = call_user_func_array($resultat['_controller'], [$request]);
   
} catch(ResourceNotFoundException $e) {
    $response = new Response('Page not found', 404);
} catch(Exception $e) {
    $response = new Response('Error on the server', 500);
}


// Envoie la réponse au navigateur
$response->send();
