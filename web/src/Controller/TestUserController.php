<?php

namespace App\Controller;

use App\Entity\Fruit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestUserController extends AbstractController
{

    public function __construct(public EntityManagerInterface $entityManager)
    {

    }

    #[Route('/user/test', name: 'user_test')]
    public function displayPage() : Response{
        return $this->render('user/testUser.html.twig');
    }

}