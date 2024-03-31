<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require __DIR__ . '/vendor/autoload.php';

$request = Request::createFromGlobals();
$response = new Response();

$map = [
    '/bonjour' => 'hello.php',
    '/bye' => 'bye.php'
];

$pathInfo = $request->getPathInfo();

if (isset($map[$pathInfo])) {
    include __DIR__ . '/src/pages/' . $map[$pathInfo];
} else{
    $response->setStatusCode(404);
    $response->setContent('Not found');
}

$response->send();
