<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RequestService
{
    public function __construct(
        public HttpClientInterface $client,
        public string              $token
    )
    {
    }

    public function request(string $method, string $url, array $options = []): array
    {
        try {
            $options = array_merge($options, [
                'headers' => [
                    'Authorization' => [
                        'Discogs token="' . $this->token . '"',
                    ]
                ],
            ]);
            $response = $this->client->request($method, $url, $options);
            return $response->toArray();
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        } catch (TransportExceptionInterface $e) {
            return ['error' => $e->getMessage()];
        }
    }
}