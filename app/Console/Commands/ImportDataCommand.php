<?php

namespace App\Console\Commands;

use App\Models\BaoHanh;
use App\Models\Product;
use Illuminate\Console\Command;

class ImportDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:data {--file= : JSON file to import (products.json or baohanhs.json)} {--model= : Model name (Product or BaoHanh)} {--keep-data : Keep existing data (default is to truncate)}';

    /**
     * The description of the console command.
     *
     * @var string
     */
    protected $description = 'Import products and baohanhs from JSON files (truncates table by default)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = $this->option('file');
        $modelName = $this->option('model');
        $keepData = $this->option('keep-data');
        $truncate = !$keepData; // Mặc định truncate = true, trừ khi có --keep-data

        if (!$file && !$modelName) {
            // Interactive mode - ask user
            $choice = $this->choice('What do you want to import?', [
                'Both (products and baohanhs)',
                'Products only',
                'Baohanhs only',
            ]);

            $truncate = !$this->confirm('Keep existing data?', false); // Mặc định xóa dữ liệu cũ

            switch ($choice) {
                case 'Both (products and baohanhs)':
                    $this->importProducts($truncate);
                    $this->importBaohanhs($truncate);
                    break;
                case 'Products only':
                    $this->importProducts($truncate);
                    break;
                case 'Baohanhs only':
                    $this->importBaohanhs($truncate);
                    break;
            }
        } else {
            if (!$file || !$modelName) {
                $this->error('Both --file and --model options are required!');
                $this->info('Usage: php artisan import:data --file=products.json --model=Product');
                return 1;
            }

            if ($modelName === 'Product') {
                $this->importProducts($truncate, $file);
            } elseif ($modelName === 'BaoHanh') {
                $this->importBaohanhs($truncate, $file);
            } else {
                $this->error("Invalid model: {$modelName}. Use 'Product' or 'BaoHanh'");
                return 1;
            }
        }

        $this->info("\n✓ Import completed successfully!");
        return 0;
    }

    private function importProducts($truncate = false, $filePath = null)
    {
        $filePath = $filePath ?? 'storage/app/exports/products.json';

        if (!file_exists($filePath)) {
            $this->error("File not found: {$filePath}");
            return;
        }

        try {
            $data = json_decode(file_get_contents($filePath), true);

            if (empty($data)) {
                $this->warn("No data to import from {$filePath}");
                return;
            }

            if ($truncate) {
                Product::truncate();
                $this->info("Truncated products table");
            }

            $bar = $this->output->createProgressBar(count($data));
            $bar->start();

            foreach ($data as $item) {
                Product::updateOrCreate(
                    ['id' => $item['id']],
                    $item
                );
                $bar->advance();
            }

            $bar->finish();
            $this->info("\n✓ Imported " . count($data) . " products");
        } catch (\Exception $e) {
            $this->error("\n✗ Error importing products: " . $e->getMessage());
        }
    }

    private function importBaohanhs($truncate = false, $filePath = null)
    {
        $filePath = $filePath ?? 'storage/app/exports/baohanhs.json';

        if (!file_exists($filePath)) {
            $this->error("File not found: {$filePath}");
            return;
        }

        try {
            $data = json_decode(file_get_contents($filePath), true);

            if (empty($data)) {
                $this->warn("No data to import from {$filePath}");
                return;
            }

            if ($truncate) {
                BaoHanh::truncate();
                $this->info("Truncated baohanhs table");
            }

            $bar = $this->output->createProgressBar(count($data));
            $bar->start();

            foreach ($data as $item) {
                BaoHanh::updateOrCreate(
                    ['id' => $item['id']],
                    $item
                );
                $bar->advance();
            }

            $bar->finish();
            $this->info("\n✓ Imported " . count($data) . " baohanhs");
        } catch (\Exception $e) {
            $this->error("\n✗ Error importing baohanhs: " . $e->getMessage());
        }
    }
}
