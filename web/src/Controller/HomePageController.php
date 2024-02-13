<?php
// src/Controller/HomepageController.php
namespace App\Controller;

use App\Entity\Fruit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    public function __construct(public EntityManagerInterface $entityManager)
    {

    }

    #[Route('/', name: 'app_main')]
    public function listFruit(): Response
    {

        return $this->render('homepage.html.twig', [
            'fruits' => $this->entityManager->getRepository(Fruit::class)->findAll(),
        ]);
    }
}