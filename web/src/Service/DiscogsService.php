<?php

namespace App\Service;

class DiscogsService
{
    private string $baseUrl;

    public function __construct(
        public RequestService $requestService,
        string                $baseUrl
    )
    {
        $this->baseUrl = $baseUrl;
    }

    public function search(string $query, array $filters = []): array
    {
        $url = $this->baseUrl . 'database/search?q=' . $query;
        if (!empty($filters)) {
            $url .= '&' . implode('&', $filters);
        }
        dump($url);
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
}