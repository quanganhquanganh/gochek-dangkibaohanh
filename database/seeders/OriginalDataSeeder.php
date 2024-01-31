<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WarrantyCode;
use App\Models\WarrantyType;
use App\Models\Warranty;
use Illuminate\Support\Facades\Log;

class OriginalDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = fopen(database_path('original.csv'), 'r');

        while (($line = fgetcsv($file)) !== FALSE ) {
            // Search code in database
            Log::info($line);
            $code = WarrantyCode::where('code', $line[3])->first();
            if (!$code) {
                continue;
            }
            // Get the first two characters of the code
            $type = WarrantyType::where('code', substr($line[3], 0, 2))->first();
            if (!$type) {
                continue;
            }

            // Create the warranty
            Warranty::updateOrCreate(
                ['warranty_code_id' => $code->id],
                [
                    'warranty_code_id' => $code->id,
                    'warranty_type_id' => $type->id,
                    'created_at' => $line[0],
                    'name' => $line[1],
                    'phone' => $line[2],
                    'store' => $line[5],
                    'ip_address' => $line[6],
                ]
            );
        }

        fclose($file);
    }
}
