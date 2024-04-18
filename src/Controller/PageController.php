<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class PageController
{
    public function about()
    {

        //intégrer du HTML
        ob_start();
        include __DIR__ . '/../pages/other/about.php';
        //renvoyer la réponse
        return new Response(ob_get_clean());
    }
}
