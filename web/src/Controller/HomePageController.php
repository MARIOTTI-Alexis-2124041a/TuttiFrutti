<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/')]
    public function number(): Response
    {
        $number = random_int(0, 100);

        return $this->render('homepage.html.twig', [
            'number' => $number,
        ]);
    }
}