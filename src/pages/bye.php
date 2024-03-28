<?php

use Symfony\Component\HttpFoundation\Response;


$response = new Response();
$response->setContent('Goodbye !');
$response->send();
