<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class RequestService
{
    public function __construct(
        public HttpClientInterface $client
    )
    {
    }

    public function request(string $method, string $url, array $options = []): array
    {
        try {
            $response = $this->client->request($method, $url, $options);
            return $response->toArray();
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function addAuthentification()
    {

    }
}