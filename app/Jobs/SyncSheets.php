<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\WarrantyCode;
use Illuminate\Support\Facades\Log;

class SyncSheets implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $client = new Client();
        $response = $client->get(env('GOCHEK_ALL_CODES_SHEET') . 'export?format=xlsx');

        $path = storage_path('app/public/gojek.xlsx');
        file_put_contents($path, $response->getBody());

        $spreadsheet = IOFactory::load($path);
        $sheetCount = $spreadsheet->getSheetCount();
        $updated = 0;

        for ($i = 0; $i < $sheetCount; $i++) {
            $sheet = $spreadsheet->getSheet($i);
            $maxCell = $sheet->getHighestRowAndColumn();

            Log::info([$sheet->getTitle(), $maxCell['row'], $maxCell['column']]);

            $data = $sheet->rangeToArray(
                'A1:' . $maxCell['column'] . $maxCell['row'],
                null,
                true,
                true,
                true
            );

            foreach ($data as $row) {
                foreach ($row as $cell) {
                    if (empty($cell)) {
                        continue;
                    }
                    $value = $cell;
                    if (preg_match('/^[A-Z]{2}\d{5,}$/', $value)) {
                        // First or create the code, and increment the updated count
                        WarrantyCode::firstOrCreate(['code' => $value])
                            ? $updated++
                            : null;
                    }
                }
            }
        }
        Log::info("Updated {$updated} codes");
    }
}
