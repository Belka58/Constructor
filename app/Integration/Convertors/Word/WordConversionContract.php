<?php

namespace App\Integration\Convertors\Word;

use GuzzleHttp\Exception\GuzzleException;

interface WordConversionContract
{
    /** @throws GuzzleException */
    public function convert(string $outputName, mixed $htmlFile): mixed;
}
