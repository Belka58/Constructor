<?php

namespace App\Integration\Convertors\Pdf;

use GuzzleHttp\Exception\GuzzleException;

interface PdfConversionContract
{
    /** @throws GuzzleException */
    public function convert(string $outputName, mixed $htmlFile): mixed;
}
