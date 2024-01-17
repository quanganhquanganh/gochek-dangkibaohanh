<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WarrantyType;

class DatabaseSeeder extends Seeder
{
    private array $warrantNames = [
        'AA' => 'Micro thu âm Gochek Ultra Đơn, không hộp sạc TYPE-C',
        'AB' => 'Micro thu âm Gochek Ultra Đơn, không hộp sạc Lightning',
        'AC' => 'Micro thu âm Gochek Ultra Đôi, không hộp sạc TYPE-C',
        'AD' => 'Micro thu âm Gochek Ultra Đôi, không hộp sạc Lightning',
        'AE' => 'Micro thu âm Gochek Ultra Đơn, có hộp sạc TYPE-C',
        'AG' => 'Micro thu âm Gochek Ultra Đơn, có hộp sạc Lightning',
        'AH' => 'Micro thu âm Gochek Ultra Đôi, có hộp sạc TYPE-C',
        'AF' => 'Micro thu âm Gochek Ultra Đôi, có hộp sạc Lightning',
        'BA' => 'Micro thu âm Gochek Ultra Plus Đơn, không hộp sạc',
        'BB' => 'Micro thu âm Gochek Ultra Plus Đôi, không hộp sạc',
        'BC' => 'Micro thu âm Gochek Ultra Plus Đôi, có hộp sạc',
        'HA' => 'Micro thu âm Gochek Ultra S24 Đơn, không hộp sạc',
        'HB' => 'Micro thu âm Gochek Ultra S25 Đôi, không hộp sạc',
        'HC' => 'Micro thu âm Gochek Ultra S26 Đôi, có hộp sạc',
        'CA' => 'Tai nghe SpaceX E1000 Trắng (White)',
        'CB' => 'Tai nghe SpaceX E1001 Đen (Black)',
        'DA' => 'Loa Stomix C8 Đen (01)',
        'DB' => 'Loa Stomix C9 Rằn ri (02)',
        'DC' => 'Loa Stomix C10 Xám (03)',
        'DD' => 'Loa Stomix C11 Xanh (04)',
        'EA' => 'Gimbal Gochek HunteX G5',
        'GA' => 'Gậy chụp ảnh SS100',
        'FA' => 'Củ sạc A9',
    ];

    private array $warrantyDurations = [
        'AA' => 12,
        'AB' => 12,
        'AC' => 12,
        'AD' => 12,
        'AE' => 12,
        'AG' => 12,
        'AH' => 12,
        'AF' => 12,
        'BA' => 12,
        'BB' => 12,
        'BC' => 12,
        'HA' => 12,
        'HB' => 12,
        'HC' => 12,
        'CA' => 12,
        'CB' => 12,
        'DA' => 6,
        'DB' => 6,
        'DC' => 6,
        'DD' => 6,
        'EA' => 12,
        'GA' => 12,
        'FA' => 12,
    ];

    private array $warrantyKeywords = [
        'AA' => ['micro'],
        'AB' => ['micro'],
        'AC' => ['micro'],
        'AD' => ['micro'],
        'AE' => ['micro'],
        'AG' => ['micro'],
        'AH' => ['micro'],
        'AF' => ['micro'],
        'BA' => ['micro', 'plus'],
        'BB' => ['micro', 'plus'],
        'BC' => ['micro', 'plus'],
        'HA' => ['micro', 's24'],
        'HB' => ['micro', 's25'],
        'HC' => ['micro', 's26'],
        'CA' => ['e1000'],
        'CB' => ['e1001'],
        'DA' => ['c8'],
        'DB' => ['c9'],
        'DC' => ['c10'],
        'DD' => ['c11'],
        'EA' => ['g5'],
        'GA' => ['ss100'],
        'FA' => ['a9'],
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach ($this->warrantNames as $code => $name) {
            WarrantyType::updateOrCreate(
                ['code' => $code],
                [
                    'name' => $name,
                    'duration' => $this->warrantyDurations[$code],
                    'keywords' => json_encode($this->warrantyKeywords[$code]),
                ]
            );
        }
    }
}
