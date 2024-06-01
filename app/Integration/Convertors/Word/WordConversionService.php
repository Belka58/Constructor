<?php

namespace App\Integration\Convertors\Word;

use App\Integration\HttpClient;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

class WordConversionService extends HttpClient implements WordConversionContract
{
    public function convert(string $outputName, mixed $htmlFile): mixed
    {
        $response = $this->request('POST', 'https://api.apyhub.com/convert/html-file/doc-file', [
            RequestOptions::QUERY => [
                'output' => $outputName,
            ],
            RequestOptions::MULTIPART => [
                [
                    'name' => 'file',
                    'contents' => $htmlFile,
                    'filename' => 'tmp.html'
                ]
            ]
        ]);

        return $response->getBody()->getContents();
    }

    public function getConfig(): array
    {
        $config = parent::getConfig();
        $config[RequestOptions::HEADERS]['apy-token'] = 'APY06jKjZsPkZ0n89HUzW741WqDzjBvzP7A4xPwnt5AyN80nTHJU5czR6ZStlZvS';
        $config[RequestOptions::HEADERS]['content-type'] = 'multipart/form-data';

        return $config;
    }
}
