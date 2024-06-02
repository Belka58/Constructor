<?php

namespace App\Integration\Convertors\Word;

use App\Integration\HttpClient;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

class WordConversionService extends HttpClient implements WordConversionContract
{
    public function convert(string $outputName, mixed $htmlFile): string
    {
        $response = $this->request('POST', '/doc-file', [
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
}
