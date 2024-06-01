<?php

namespace App\Integration;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class HttpClient
{
    private Client|null $instance = null;

    public function getInstance(): Client
    {
        if (!isset($this->instance)) {
            $this->instance = new Client($this->getConfig());
        }

        return $this->instance;
    }

    /** @throws GuzzleException */
    public function request(string $method, $uri = '', array $options = []): ResponseInterface
    {
        return $this->getInstance()->request($method, $uri, $this->getOptions($options));
    }

    public function getConfig(): array
    {
        return [];
    }

    public function getOptions(array $options): array
    {
        return $options;
    }

}
