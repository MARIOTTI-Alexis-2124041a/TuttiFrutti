<?php

namespace App\Controller;

use App\Service\FavoriteService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavoriteController extends AbstractController
{

    public function __construct(
         private readonly FavoriteService $favoriteService,
         private LoggerInterface $logger
    ) {
    }


    #[Route('/user/addFavorite', name: 'add_favorite')]
    public function addFavorite(Request $request): JsonResponse

    {
        $dataMap = $request->toArray();

        if ($this->favoriteService->addFavorite($dataMap)) {
            return $this->json([
                'success' => true, // Send status in the response
            ]);
        } else {
            return $this->json([
                'success' => false, // Send status in the response
            ]);
        }


    }

    #[Route('/user/removeFavorite', name: 'remove_favorite')]
    public function removeFavorite(Request $request)
    {
        $dataMap = $request->toArray();

        if ($this->favoriteService->removeFavorite($dataMap)) {
            return $this->json([
                'success' => true, // Send status in the response
            ]);
        } else {
            return $this->json([
                'success' => false, // Send status in the response
            ]);
        }
    }
}