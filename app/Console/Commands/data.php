<?php

namespace App\Console\Commands;

use App\Traits\XmlSpreadsheetTrait;
use App\Services\GoogleSheet;

use Illuminate\Console\Command;

class data extends Command
{
    use XmlSpreadsheetTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'open:xml';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $class = new GoogleSheet();
        $path = 'public/coffee_feed.xml';
        $file = file_get_contents('public/coffee_feed.xml');
        if (file_exists($path)) {
            $xmlFile = simplexml_load_string($file);
            $json = json_encode($xmlFile);
            $array = (json_decode($json, true))['item'];
            // print_r($array);
        } else {
            echo 'This file is not available';
        }

        $this->info(string: 'Welcome to the XML file');
        $newData = $this->getXmlDataToArray($array);
        $class->saveDataToSpreadsheet($newData);
        // $this->google_sheet->saveDataToSheet($newData);
        //     dump($newData);
        // info(json_encode($newData));
    }
}
