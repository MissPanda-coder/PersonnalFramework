<?php

// pour démarrer le serveur dans la terminalphp -S localhost:3000 -t public
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require __DIR__ . '/../vendor/autoload.php';

// Crée une instance de la classe Request à partir des données globales
$request = Request::createFromGlobals();

// Crée une nouvelle instance de la classe Response
$response = new Response();

// Définit une correspondance entre les chemins et les fichiers à inclure
$map = [
    '/bonjour' => 'hello.php',
    '/bye' => 'bye.php',
    '/a-propos' => 'test/about.php',
];

// Récupère le chemin de la requête actuelle
$pathInfo = $request->getPathInfo();

// Vérifie si le chemin de la requête existe dans la correspondance définie
if (isset($map[$pathInfo])) {
    // Démarre la capture de sortie. La gestion de la Bufferisation s'effectue avec la fonction ob_start(). Cette fonction temporise l'envoi du flux (du buffer), de telle sorte qu'on puisse envoyer le buffer d'un seul coup, soit à la fin de notre code (ce qui se fait automatiquement), soit à un moment de notre choix.
    ob_start();
    
    // Inclut le fichier correspondant au chemin de la requête
    include __DIR__ . '/../src/pages/' . $map[$pathInfo];
    
    // Récupère le contenu de la capture de sortie, puis vide la mémoire tampon
    $response->setContent(ob_get_clean());
} else {
    // Si le chemin de la requête n'est pas trouvé, définit le code de statut de réponse à 404
    $response->setStatusCode(404);
    
    // Définit le contenu de la réponse à 'Not found'
    $response->setContent('Not found');
}

// Envoie la réponse au client
$response->send();
