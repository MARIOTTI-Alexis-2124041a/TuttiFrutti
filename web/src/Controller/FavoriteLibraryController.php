<?php

namespace App\Controller;

use App\Service\FavoriteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FavoriteLibraryController extends AbstractController
{
    public function __construct(
        private readonly FavoriteService $favoriteService
    )
    {
    }

    #[Route('/user/library', name: 'app_favorite_library')]
    public function index(): Response
    {

        $favorites = $this->favoriteService->getFavorites();

        $result = [];

        for ($i = 0; $i < count($favorites); $i++) {
            $result[$i] = $favorites[$i]->toArray();
            $result[$i]['isFavorite'] = $this->favoriteService->checkIfFavorite($favorites[$i]->getName(), $favorites[$i]->getType());
        }

        return $this->render('favorite_library/favoriteLibrary.html.twig', [
            'controller_name' => 'FavoriteLibraryController',
            'results' => $result,
        ]);
    }
}
