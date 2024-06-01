<?php

namespace App\Console\Commands;

use App\Integration\Convertors\Word\WordConversionContract;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Tighten\Ziggy\Ziggy;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @throws GuzzleException
     */
    public function handle(WordConversionContract $contract): void
    {
        $filename = 'sss.docx';
        $file = tmpfile();
        fwrite($file, Blade::render('work-program', [
            'year' => 2023,
            'header' => 'Комитет образования,  науки и молодежной политики Волгоградской области'
        ]));

        $file = $contract->convert($filename, $file);

        Storage::put($filename, $file);
    }
}
