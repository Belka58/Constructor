<?php

namespace App\Integration;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
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
    public function request(string $method, $url = '', array $options = []): ResponseInterface
    {
        return $this->getInstance()->request($method, 'https://api.apyhub.com/convert/html-file'. $url, $this->getOptions($options));
    }

    public function getConfig(): array
    {
        return [
            RequestOptions::HEADERS => [
                'apy-token' => 'APY06jKjZsPkZ0n89HUzW741WqDzjBvzP7A4xPwnt5AyN80nTHJU5czR6ZStlZvS',
                'content-type' => 'multipart/form-data'
            ]
        ];
    }

    public function getOptions(array $options): array
    {
        return $options;
    }

}
