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
        $typeFilter = $request->query->get('artist');
        $result = null;
        if ($query) {
            $filters = [];
            if ($typeFilter) {
                $typeFilter = explode(",", $typeFilter);
                foreach ($typeFilter as $filter) {
                    $filters[] = 'artist=' . $filter;
                }
            }
            dump($query, $typeFilter, $filters);
            $result = [];
            if (empty($filters)) {
                $result = $this->discogsService->search($query);
            }
            foreach ($filters as $filter) {
                dump($filter);
                $result = array_merge($result, $this->discogsService->search($query, [$filter]));
            }
            $artists = array_unique(array_map(function($result) {
                if ($result['type'] === 'Label') {
                    return null;
                } elseif ($result['type'] != 'Label') {
                    return explode(' - ', $result['title'])[0];
                } else {
                    return null;
                }
            }, $result));
            dump($result, $artists);
        }
        return $this->render('search.html.twig', [
            'result' => $result,
            'artists' => $artists ?? [],
            'fruits' => $this->entityManager->getRepository(Fruit::class)->findAll(),
        ]);
    }

}