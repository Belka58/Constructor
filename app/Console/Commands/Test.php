<?php

namespace App\Console\Commands;

use App\Integration\Convertors\Pdf\PdfConversionContract;
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
    public function handle(PdfConversionContract $contract): void
    {
        $filename = 'sss.pdf';
        $file = tmpfile();
        fwrite($file, Blade::render('work-program', [
            'header' => 'Комитет образования, науки и молодежной политики Волгоградской области 111 11231 124124 1241 ',
            'workProgramName' => 'Основы алгоритмизации и программирования 111',
            'specialnost' => ' 09.02.07 Информационные системы и программирование 1',
            'curse' => '2,4',
            'orgRazrab' => 'государственное бюджетное профессиональное образовательное учреждение «Волжский политехнический техникум» (ГБ ПОУ «ВПТ»).1',
            'razrabi' => [
                'Дмитриев Алексей Андреевич – преподаватель ГБ ПОУ «ВПТ»',
                'хуесос'
            ],
            'rechesents' => [
                'Дмитриев Алексей Андреевич – преподаватель ГБ ПОУ «ВПТ»',
                'хуесос'
            ],
        ]));

        $file = $contract->convert($filename, $file);

        Storage::put($filename, $file);
    }
}
