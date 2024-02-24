<?php

namespace App\Service;

use App\Entity\Fruit;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class DiscogsService
{
    private string $baseUrl;

    public function __construct(
        public RequestService                  $requestService,
        string                                 $baseUrl,
        public readonly EntityManagerInterface $entityManager
    )
    {
        $this->baseUrl = $baseUrl;
    }

    public function search(string $query, array $filters = []): array
    {
        if (!$this->entityManager->getRepository(Fruit::class)->findOneBy(['name' => $query])) {
            throw new \InvalidArgumentException('Not a fruit');
        }
        $url = $this->baseUrl . 'database/search?q=' . $query;
        if (!empty($filters)) {
            $url .= '&' . implode('&', $filters);
        }
        $url .= '&per_page=100';
        try {
            $results = $this->requestService->request('GET', $url)['results'];
            foreach ($results as &$result) {
                switch ($result['type']) {
                    case 'release':
                        $result['type'] = 'Album';
                        break;
                    case 'master':
                        $result['type'] = 'Master';
                        break;
                    case 'artist':
                        $result['type'] = 'Artiste';
                        break;
                    case 'label':
                        $result['type'] = 'Label';
                        break;
                }
            }
            return $results;
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getDetails(string $resourceUrl): array
    {
        try {
            $type = '';
            if (str_contains($resourceUrl, 'discogs.com/releases') or str_contains($resourceUrl, 'discogs.com/masters')) {
                $type = 'release';
            } else if (str_contains($resourceUrl, 'discogs.com/artists')) {
                $type = 'artist';
            }
            $details = $this->requestService->request('GET', $resourceUrl);
            if ($type === 'artist') {
                $details['releases'] = $this->requestService->request('GET', $details['releases_url'])['releases'];
            }
            return $details;
        } catch (\Exception $e) {
            return [];
        }
    }
}