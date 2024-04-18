<?php

// pour démarrer le serveur dans le terminal php -S localhost:3000 -t public

use Framework\Event\RequestEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\Contracts\EventDispatcher\Event;


require __DIR__ . '/../vendor/autoload.php';



$request = Request::createFromGlobals();
$routes = require __DIR__ . '/../src/routes.php';
$context = new RequestContext();


$urlMatcher = new UrlMatcher($routes, $context);

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$dispatcher = new EventDispatcher();
$dispatcher->addListener('kernel.request', function(RequestEvent $event){
   $event->getRequest()->attributes->set('prénom', 'Adeline');
});

//outil qu'on crée 
$framework = new Framework\Simplex($dispatcher, $urlMatcher, $controllerResolver, $argumentResolver);


//on lui passe une requête, il nous donne un réponse
$response = $framework->handle($request);

// il envoie la réponse au navigateur
$response->send();
