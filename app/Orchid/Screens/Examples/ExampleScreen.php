<?php

namespace App\Orchid\Screens\Examples;

use App\Models\Warranty;
use App\Models\WarrantyCode;
use App\Orchid\Layouts\Examples\ChartBarExample;
use App\Orchid\Layouts\Examples\ChartLineExample;
use App\Orchid\Layouts\Examples\RegisteBarChart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Components\Cells\Currency;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Repository;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;

class ExampleScreen extends Screen
{
    /**
     * Fish text for the table.
     */
    public const TEXT_EXAMPLE = 'Lorem ipsum at sed ad fusce faucibus primis, potenti inceptos ad taciti nisi tristique
    urna etiam, primis ut lacus habitasse malesuada ut. Lectus aptent malesuada mattis ut etiam fusce nec sed viverra,
    semper mattis viverra malesuada quam metus vulputate torquent magna, lobortis nec nostra nibh sollicitudin
    erat in luctus.';

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'charts' => $this->datasetWarrantyRegisterChart(),
            'table' => [
                new Repository(['id' => 100, 'name' => self::TEXT_EXAMPLE, 'price' => 10.24, 'created_at' => '01.01.2020']),
                new Repository(['id' => 200, 'name' => self::TEXT_EXAMPLE, 'price' => 65.9, 'created_at' => '01.01.2020']),
                new Repository(['id' => 300, 'name' => self::TEXT_EXAMPLE, 'price' => 754.2, 'created_at' => '01.01.2020']),
                new Repository(['id' => 400, 'name' => self::TEXT_EXAMPLE, 'price' => 0.1, 'created_at' => '01.01.2020']),
                new Repository(['id' => 500, 'name' => self::TEXT_EXAMPLE, 'price' => 0.15, 'created_at' => '01.01.2020']),

            ],
            'metrics' => [
                'sales' => ['value' => number_format(6851), 'diff' => 10.08],
                'visitors' => ['value' => number_format(24668), 'diff' => -30.76],
                'orders' => ['value' => number_format(10000), 'diff' => 0],
                'total' => number_format(65661),
                'totalCode' => number_format(WarrantyCode::count()),
                'totalWarranty' => number_format(Warranty::count()),
                'warrantyRegisterToday' => number_format(Warranty::whereDate('created_at', Carbon::today())->count()),
                'warrantyRegisterYesterday' => number_format(Warranty::whereDate('created_at', Carbon::yesterday())->count()),
                'pageViewToday' => number_format($this->getPageView()),
                'pageViewYesterday' => number_format($this->getPageView()),
            ],
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Thống kê';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Các dữ liệu liên quan đến việc tra cứu bảo hành';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            // Button::make('Show toast')
            //     ->method('showToast')
            //     ->novalidate()
            //     ->icon('bs.chat-square-dots'),

            // ModalToggle::make('Launch demo modal')
            //     ->modal('exampleModal')
            //     ->method('showToast')
            //     ->icon('bs.window'),

            //Select period time for statistics
//            Button::make('Chọn thời gian')
//                ->method('showToast')
//                ->icon('bs.calendar'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            Layout::metrics([
                'Lượt đăng kí bảo hành hôm nay' => 'metrics.warrantyRegisterToday',
                'Lượt truy cập hôm nay' => 'metrics.pageViewToday',
                'Tổng số mã đã kích hoạt' => 'metrics.totalWarranty',
                'Tổng số mã bảo hành' => 'metrics.totalCode',
            ]),
            ChartBarExample::make('charts', 'Biểu đồ lượt đăng kí bảo hành theo tháng')
                ->description('Thống kê theo 12 tháng gần nhất'),
//            Layout::columns([
//                ChartLineExample::make('charts', 'Line Chart')
//                    ->description('Visualize data trends with multi-colored line graphs.'),
//
//                ChartBarExample::make('charts', 'Bar Chart')
//                    ->description('Compare data sets with colorful bar graphs.'),
//            ]),

//            Layout::table('table', [
//                TD::make('id', 'ID')
//                    ->width('100')
//                    ->render(fn(Repository $model) => // Please use view('path')
//                        "<img src='https://loremflickr.com/500/300?random={$model->get('id')}'
//                              alt='sample'
//                              class='mw-100 d-block img-fluid rounded-1 w-100'>
//                            <span class='small text-muted mt-1 mb-0'># {$model->get('id')}</span>"),
//
//                TD::make('name', 'Name')
//                    ->width('450')
//                    ->render(fn(Repository $model) => Str::limit($model->get('name'), 200)),
//
//                TD::make('price', 'Price')
//                    ->width('100')
//                    ->usingComponent(Currency::class, before: '$')
//                    ->align(TD::ALIGN_RIGHT)
//                    ->sort(),
//
//                TD::make('created_at', 'Created')
//                    ->width('100')
//                    ->usingComponent(DateTimeSplit::class)
//                    ->align(TD::ALIGN_RIGHT),
//            ]),

            Layout::modal('exampleModal', Layout::rows([
                Input::make('toast')
                    ->title('Messages to display')
                    ->placeholder('Hello world!')
                    ->help('The entered text will be displayed on the right side as a toast.')
                    ->required(),
            ]))->title('Create your own toast message'),
        ];
    }

    public function showToast(Request $request): void
    {
        Toast::warning($request->get('toast', 'Hello, world! This is a toast message.'));
    }

    public function datasetWarrantyRegisterChart(): array
    {
        $endDate = Carbon::now(); // Ngày hiện tại
        $startDate = $endDate->copy()->subMonths(11); // Ngày 12 tháng trước

        $labels = [];

        // Tạo danh sách các tháng dưới dạng văn bản
        while ($startDate <= $endDate) {
            $labels[] = $startDate->format('m/y'); // 'F Y' lấy tên tháng và năm
            $startDate->addMonth(); // Tăng tháng lên 1
        }

        $listName = [
            'Cửa hàng Đại lý Ủy quyền',
            'Facebook',
            'TikTok Shop',
            'Shopee',
            'Lazada',
            'Website',
            'Khác'
        ];

        $datasets = [];

        foreach ($listName as $name) {
            if ($name === 'Khác') {
                $warrantyData = Warranty::whereNotIn('store', $listName);
            } else {
                $warrantyData = Warranty::where('store', $name);
            }
            $query =$warrantyData
                ->whereBetween('created_at', [$endDate->copy()->subMonths(11)->startOfMonth(), $endDate->copy()->endOfMonth()])
                ->get()
//                ->each(function ($item) {
//                    $formattedDate = $item->created_at->format('M/Y');
//                    Log::info("Original Date: " . $item->created_at . " | Formatted Date: $formattedDate\n");
//                })
                ->groupBy(function ($item) {
                    return $item->created_at->format('m/y');
                })
//                ->each(function ($group, $key) {
//                    Log::info("Group: $key | Count: " . count($group) . "\n");
//                })
                ->map(function ($group, $key) {
                    return [
                        'name' => $key,
                        'count' => count($group)
                    ];
                })
                ->values()
                ->toArray();

            $queryWithZeros = [];
            foreach ($labels as $month) {
                $found = false;
                foreach ($query as $data) {
                    if ($data['name'] === $month) {
                        $queryWithZeros[] = $data;
                        $found = true;
                        break;
                    }
                }

                if (!$found) {
                    $queryWithZeros[] = [
                        'name' => $month,
                        'count' => 0,
                    ];
                }
            }

            $datasets[] = [
                'name' => $name,
                'values' => array_column($queryWithZeros, 'count'),
                'labels' => $labels,
            ];


        }
        return $datasets;
    }

    private function getPageView()
    {
        try {
            $analyticsData = Analytics::fetchTotalVisitorsAndPageViews(Period::days(1));
            Log::info($analyticsData->toJson());
            return $analyticsData[0]['screenPageViews'];
        } catch (\Exception $e) {
            Log::error("Error fetching analytics data: " . $e->getMessage());
            return 0;
        }
    }
}
