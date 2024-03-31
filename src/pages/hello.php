<?php


$name = $request->query->get('name', 'World');

$response->headers->set('Content-Type', 'text/html; charset=UTF-8');
$response->setContent(sprintf('Hello %s', htmlspecialchars($name, ENT_QUOTES, 'UTF-8')));


// $name = $request->query->get('name', 'World');
// ce qui revient à cette condition ternaire (quand on a pas le httpFoudation) qui veut dire si la variable $name est remplie, on lui affecte la valeur de $name sinon lui affecte la valeur 'World' par défaut
// $name = isset($_GET['name']) ? $_GET['name'] : 'World';
// header('Content-Type: text/html; charset=UTF-8');
// Affichage avec l'instruction printf
// A la manière de putchar, l'instruction printf permet de faire afficher à l'écran la valeur d'une variable, un libellé, la valeur d'une expression, une chaîne de caractères, et cela selon divers formats (associés aux différents types de variables). Les types de variables sont les suivants : string, int, float, bool, array, object, resource, null. ici, le %s correspond à un string. cela veut dire qu'on a fait un trou pour afficher une chaine de caractères.
// printf('Hello %s',htmlspecialchars($name, ENT_QUOTES, 'UTF-8'));