<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\WarrantyNhanhvnType;
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
        'AA' => ['micro', 'mic'],
        'AB' => ['micro', 'mic'],
        'AC' => ['micro', 'mic'],
        'AD' => ['micro', 'mic'],
        'AE' => ['micro', 'mic'],
        'AG' => ['micro', 'mic'],
        'AH' => ['micro', 'mic'],
        'AF' => ['micro', 'mic'],
        'BA' => ['micro', 'plus', 'mic'],
        'BB' => ['micro', 'plus', 'mic'],
        'BC' => ['micro', 'plus', 'mic'],
        'HA' => ['micro', 's24', 'mic'],
        'HB' => ['micro', 's25', 'mic'],
        'HC' => ['micro', 's26', 'mic'],
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

    private array $warrantyNhanhvnTypes = [
        '2000214247831' => [
            'name' => 'Adapter GoChek (Củ sạc)',
            'duration' => 12,
        ],
        '2000214247572' => [
            'name' => 'Micro-GoChek D Ultra Plus',
            'duration' => 12,
        ],
        '2000214247565' => [
            'name' => 'Micro-GoChek B Ultra Plus',
            'duration' => 12,
        ],
        '2000214247558' => [
            'name' => 'Micro-GoChek A Ultra Plus',
            'duration' => 12,
        ],
        '2000214247466' => [
            'name' => 'Gậy chụp ảnh GoChek SS100',
            'duration' => 12,
        ],
        '2000214247459' => [
            'name' => 'Tai Nghe Bluetooth GoChek SpaceX Màu White',
            'duration' => 12,
        ],
        '2000214247442' => [
            'name' => 'Tai Nghe Bluetooth GoChek SpaceX Màu Black',
            'duration' => 12,
        ],
        '2000214247435' => [
            'name' => 'Loa Bluetooth Gochek Stomix Màu Black',
            'duration' => 6,
        ],
        '2000214247428' => [
            'name' => 'Loa Bluetooth Gochek Stomix Màu Camou',
            'duration' => 6,
        ],
        '2000214247411' => [
            'name' => 'Loa Bluetooth Gochek Stomix Màu Grey',
            'duration' => 6,
        ],
        '2000214247404' => [
            'name' => 'Loa Bluetooth Gochek Stomix Màu Blue',
            'duration' => 6,
        ],
        '2000205050297' => [
            'name' => 'Micro Gochek C02 ultra',
            'duration' => 12,
        ],
        '2000205050259' => [
            'name' => 'Micro Gochek D02 ultra',
            'duration' => 12,
        ],
        '2000205050242' => [
            'name' => 'Micro Gochek D01 ultra',
            'duration' => 12,
        ],
        '2000205050150' => [
            'name' => 'Micro Gochek C01 ultra',
            'duration' => 12,
        ],
        '2000205050136' => [
            'name' => 'Micro Gochek B02 ultra',
            'duration' => 12,
        ],
        '2000205050112' => [
            'name' => 'Micro Gochek B01 ultra',
            'duration' => 12,
        ],
        '2000205050105' => [
            'name' => 'Micro Gochek A02 ultra',
            'duration' => 12,
        ],
        '2000205050044' => [
            'name' => 'Micro Gochek A01 ultra',
            'duration' => 12,
        ],
        '2000214247787' => [
            'name' => 'Gimbal GoChek HunteX G5',
            'duration' => 12,
        ],
    ];

    private array $storesName = [
        'Micro Ultra',
        'Micro Ultra Plus',
        'Tai nghe SpaceX',
        'Gimbal HunteX G5',
        'Gậy chụp ảnh SS100',
        'Gậy chụp ảnh S140',
        'Củ sạc A9'
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        foreach ($this->storesName as $name) {
            Product::updateOrCreate(
                ['name' => $name],
                ['name' => $name]
            );
        }

//        foreach ($this->warrantNames as $code => $name) {
//            WarrantyType::updateOrCreate(
//                ['code' => $code],
//                [
//                    'name' => $name,
//                    'duration' => $this->warrantyDurations[$code],
//                    'keywords' => json_encode($this->warrantyKeywords[$code]),
//                ]
//            );
//        }
//
//        foreach ($this->warrantyNhanhvnTypes as $code => $data) {
//            WarrantyNhanhvnType::updateOrCreate(
//                ['code' => $code],
//                [
//                    'name' => $data['name'],
//                    'duration' => $data['duration'],
//                ]
//            );
//        }
    }
}
