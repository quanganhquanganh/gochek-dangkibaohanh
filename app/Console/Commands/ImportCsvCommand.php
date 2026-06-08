<?php

namespace App\Console\Commands;

use App\Models\BaoHanh;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ImportCsvCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:csv {file? : Path to CSV file (default: database/latest.csv)} {--from= : Chỉ import từ thời gian này trở đi (format: Y-m-d h:i A, vd: 2026-02-04 10:06 PM)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import bảo hành data từ file CSV vào database (bỏ qua bản ghi trùng theo thời gian + tên + SĐT + sản phẩm)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = $this->argument('file') ?? base_path('database/latest.csv');
        $fromTime = $this->option('from');

        if (!file_exists($filePath)) {
            $this->error("File không tồn tại: {$filePath}");
            return 1;
        }

        $this->info("📄 Đọc file: {$filePath}");

        // Parse thời gian bắt đầu nếu có
        $fromDateTime = null;
        if ($fromTime) {
            $fromDateTime = $this->parseDateTime($fromTime);
            if (!$fromDateTime) {
                $this->error("❌ Định dạng thời gian không hợp lệ: {$fromTime}");
                $this->info("Sử dụng format: Y-m-d h:i A (vd: 2026-02-04 10:06 PM)");
                return 1;
            }
            $this->info("📅 Chỉ import từ: {$fromDateTime->format('Y-m-d h:i A')}");
        }

        $rows = $this->parseCsv($filePath);

        if (empty($rows)) {
            $this->warn("Không có dữ liệu hợp lệ trong file CSV.");
            return 1;
        }

        $this->info("📊 Tìm thấy " . count($rows) . " dòng dữ liệu hợp lệ");

        $imported = 0;
        $skipped = 0;
        $errors = 0;

        $bar = $this->output->createProgressBar(count($rows));
        $bar->start();

        foreach ($rows as $row) {
            try {
                // Parse thời gian từ CSV (format: "2026-02-21 03:13 PM")
                $createdAt = $this->parseDateTime($row[0] ?? null);

                if (!$createdAt) {
                    $errors++;
                    $bar->advance();
                    continue;
                }

                // Bỏ qua nếu thời gian trong CSV nhỏ hơn thời gian bắt đầu
                if ($fromDateTime && $createdAt < $fromDateTime) {
                    $skipped++;
                    $bar->advance();
                    continue;
                }

                $userName = trim($row[1] ?? '');
                $phone = trim($row[2] ?? '');
                $productName = trim($row[3] ?? '');
                $email = trim($row[4] ?? '') ?: null;
                $storeName = trim($row[5] ?? '');
                $needHelp = trim($row[6] ?? 'Không, hiện tại tôi không có thắc mắc nào');
                $code = trim($row[7] ?? '') ?: null;

                // Bỏ qua dòng thiếu thông tin bắt buộc
                if (empty($userName) || empty($phone) || empty($productName)) {
                    $errors++;
                    $bar->advance();
                    continue;
                }

                // Kiểm tra trùng: thời gian + tên + SĐT + sản phẩm
                $exists = BaoHanh::where('user_name', $userName)
                    ->where('phone', $phone)
                    ->where('product_name', $productName)
                    ->where('created_at', $createdAt)
                    ->exists();

                if ($exists) {
                    $skipped++;
                    $bar->advance();
                    continue;
                }

                BaoHanh::create([
                    'user_name'    => $userName,
                    'phone'        => $phone,
                    'product_name' => $productName,
                    'email'        => $email,
                    'store_name'   => $storeName,
                    'need_help'    => $needHelp,
                    'code'         => $code,
                    'created_at'   => $createdAt,
                    'updated_at'   => $createdAt,
                ]);

                $imported++;
            } catch (\Exception $e) {
                $errors++;
                $this->newLine();
                $this->warn("⚠ Lỗi dòng: " . ($e->getMessage()));
            }

            $bar->advance();
        }

        $bar->finish();

        $this->newLine(2);
        $this->info("✅ Hoàn tất import!");
        $this->table(
            ['Trạng thái', 'Số lượng'],
            [
                ['✓ Đã import', $imported],
                ['⊘ Bỏ qua (trùng)', $skipped],
                ['✗ Lỗi', $errors],
                ['Tổng', count($rows)],
            ]
        );

        return 0;
    }

    /**
     * Parse CSV file, bỏ qua dòng metadata đầu tiên và dòng trống.
     */
    private function parseCsv(string $filePath): array
    {
        $rows = [];
        $handle = fopen($filePath, 'r');

        if ($handle === false) {
            return [];
        }

        $lineNumber = 0;

        while (($row = fgetcsv($handle)) !== false) {
            $lineNumber++;

            // Bỏ qua dòng đầu tiên (metadata)
            if ($lineNumber === 1) {
                continue;
            }

            // Bỏ qua dòng trống
            $joined = implode('', $row);
            if (empty(trim($joined))) {
                continue;
            }

            // Bỏ qua dòng không có đủ cột cơ bản (ít nhất 7 cột: timestamp, name, phone, product, email, store, need_help)
            if (count($row) < 7) {
                continue;
            }

            // Bỏ qua dòng mà cột tên hoặc SĐT trống
            if (empty(trim($row[1] ?? '')) || empty(trim($row[2] ?? ''))) {
                continue;
            }

            $rows[] = $row;
        }

        fclose($handle);

        return $rows;
    }

    /**
     * Parse datetime từ định dạng: "2026-02-21 03:13 PM"
     */
    private function parseDateTime(?string $value): ?Carbon
    {
        if (empty($value)) {
            return null;
        }

        $value = trim($value);

        try {
            return Carbon::createFromFormat('Y-m-d h:i A', $value);
        } catch (\Exception $e) {
            return null;
        }
    }

}
