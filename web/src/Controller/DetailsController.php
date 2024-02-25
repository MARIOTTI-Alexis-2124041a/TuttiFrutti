<?php

namespace App\Controller;

use App\Service\DiscogsService;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class DetailsController extends AbstractController
{
    public function __construct(
        private readonly DiscogsService $discogsService,
        public EntityManagerInterface $entityManager,
        private LoggerInterface $logger
    )
    {
    }

    #[Route('details', methods: ['POST'])]
    public function getDetails(Request $request): JsonResponse
    {
        $this->logger->info('DetailsController::getDetails');
        $this->logger->info($request->getContent());
        foreach ($request->toArray() as $key => $value) {
            $this->logger->info($key . ' => ' . $value);
        }
        $resourceUrl = $request->toArray()['resourceUrl'];
        return new JsonResponse($this->discogsService->getDetails($resourceUrl));
    }

}