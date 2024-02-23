<?php

namespace App\Controller;

use App\Entity\Fruit;
use App\Service\DiscogsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SearchController extends AbstractController
{
    public function __construct(
        private readonly DiscogsService $discogsService,
        public EntityManagerInterface $entityManager
    )
    {
    }

    #[Route('/search', name: 'search')]
    public function search(Request $request): Response
    {
        $query = $request->query->get('query');
        $result = null;
        if ($query) {
            $result = $this->discogsService->search($query);
        }
        return $this->render('search.html.twig', [
            'result' => $result,
            'fruits' => $this->entityManager->getRepository(Fruit::class)->findAll(),
        ]);
    }

}