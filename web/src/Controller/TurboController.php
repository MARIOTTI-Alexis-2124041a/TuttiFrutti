<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TurboController extends AbstractController
{
    #[Route('/turbo-page', name: 'app_turbo_page')]
    public function page(): Response
    {
        return $this->render('turbo/page.html.twig');
    }
}