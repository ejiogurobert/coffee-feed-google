<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;

class GoogleSheet
{
    public $client, $service, $range, $googleSheetService;

    public function __construct()
    {
        $client = new Client();
        $SpreadSheetId = env('SPREADSHEET_ID');
        $client->setAuthConfig(public_path('credentials.json'));
        $client->addScope("https://www.googleapis.com/auth/spreadsheets");
        $this->googleSheetService = new Sheets($client);
    }

    public function saveDataToSpreadsheet($data)
    {
        // $this->client = $this->getClient();
        // $this->service = new Sheets($this->client);
        $range = 'A:Z';
        $spreadSheetId = env('SPREADSHEET_ID');
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        $body = new ValueRange([
            'values' => $data
        ]);
        return $this->googleSheetService->spreadsheets_values->update($spreadSheetId, $range, $body, $params);
    }
}
