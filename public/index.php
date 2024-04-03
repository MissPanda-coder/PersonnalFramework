<?php

// pour démarrer le serveur dans le terminal php -S localhost:3000 -t public
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Exception\Exception;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;

require __DIR__ . '/../vendor/autoload.php';

$request = Request::createFromGlobals();

$routes = require __DIR__ . '/../src/routes.php';

$context = new RequestContext();
$context->fromRequest($request);

$urlMatcher = new UrlMatcher($routes, $context);
$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$pathInfo = $request->getPathInfo();
try{

    $request ->attributes->add($urlMatcher->match($request->getPathInfo()));
   
    $controller = $controllerResolver->getController($request);
    $arguments = $argumentResolver->getArguments($request, $controller);
    $response = call_user_func_array($controller, $arguments);

} catch(ResourceNotFoundException $e) {
    $response = new Response('Page not found', 404);
} catch(Exception $e) {
    $response = new Response('Error on the server', 500);
}


// Envoie la réponse au navigateur
$response->send();
