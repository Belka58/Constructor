<?php

namespace App\Integration\Convertors\Pdf;

use App\Integration\HttpClient;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

class PdfConversionService extends HttpClient implements PdfConversionContract
{
    public function convert(string $outputName, mixed $htmlFile): string
    {
        $response = $this->request('POST', '/pdf-file', [
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
