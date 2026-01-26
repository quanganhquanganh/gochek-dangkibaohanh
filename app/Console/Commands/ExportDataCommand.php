<?php

namespace App\Console\Commands;

use App\Models\BaoHanh;
use App\Models\Product;
use Illuminate\Console\Command;

class ExportDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:data {--output=storage/app/exports}';

    /**
     * The description of the console command.
     *
     * @var string
     */
    protected $description = 'Export products and baohanhs tables to JSON files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $outputDir = $this->option('output');

        // Tạo thư mục nếu chưa tồn tại
        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0755, true);
        }

        // Export products
        try {
            $products = Product::all();
            $productsFile = $outputDir . '/products.json';
            file_put_contents(
                $productsFile,
                json_encode($products, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
            );
            $this->info("✓ Exported " . count($products) . " products to {$productsFile}");
        } catch (\Exception $e) {
            $this->error("✗ Error exporting products: " . $e->getMessage());
            return 1;
        }

        // Export baohanhs in batches
        try {
            $baohanhsFile = $outputDir . '/baohanhs.json';
            $allBaohanhs = [];
            $totalBaohanhs = 0;
            $batchSize = 200;

            $bar = $this->output->createProgressBar();
            $bar->setFormat('%current%/%max% [%bar%] %percent:3s%% - %message%');

            BaoHanh::orderBy('created_at', 'asc')->chunk($batchSize, function ($baohanhs) use (&$allBaohanhs, &$totalBaohanhs, &$bar) {
                foreach ($baohanhs as $baohanhItem) {
                    $allBaohanhs[] = $baohanhItem;
                    $totalBaohanhs++;
                }
                $bar->setMaxSteps($totalBaohanhs);
                $bar->advance(count($baohanhs));
                $bar->setMessage("Exporting baohanhs: {$totalBaohanhs}");
            });

            file_put_contents(
                $baohanhsFile,
                json_encode($allBaohanhs, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
            );
            $bar->finish();
            $this->info("\n✓ Exported " . $totalBaohanhs . " baohanhs to {$baohanhsFile}");
        } catch (\Exception $e) {
            $this->error("✗ Error exporting baohanhs: " . $e->getMessage());
            return 1;
        }

        $this->info("\n✓ Export completed successfully!");
        return 0;
    }
}
