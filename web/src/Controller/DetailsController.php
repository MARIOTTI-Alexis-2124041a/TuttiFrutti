<?php

namespace App\Controller;

use App\Service\DiscogsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class DetailsController extends AbstractController
{
    public function __construct(
        private readonly DiscogsService $discogsService,
        public EntityManagerInterface $entityManager
    )
    {
    }

    #[Route('details', methods: ['POST'])]
    public function getDetails(Request $request): JsonResponse
    {
        $resourceUrl = $request->toArray()['resourceUrl'];
        return new JsonResponse($this->discogsService->getDetails($resourceUrl));
    }

}