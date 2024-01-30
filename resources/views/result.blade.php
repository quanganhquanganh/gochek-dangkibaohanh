@extends('layout')

@section('content')
    <div class="w-full bg-background md:pt-10 lg:pt-20 flex flex-col justify-center items-center">
        <div class="w-full md:w-[680px] mx-auto  flex flex-col justify-between items-center bg-white text-lg p-4 rounded-xl">
            <div class="text-[30px] md:text-[40px] font-bold py-5">
                KẾT QUẢ TRA CỨU
            </div>
            @foreach($warranties as $warranty)
                <div class="w-full p-4 border-b border-gray-200">
                <div class="text-lg">Tên sản phẩm: <strong>{{ $warranty['warrantyType']['name'] }}</strong></div>
                <div class="text-lg">Thời gian bảo hành: <strong>{{ $warranty['warrantyType']['duration'] }} tháng</strong>
                </div>
                    @if(isset($warranty['case']) && $warranty['case'] == 3)
                        Thời hạn bảo hành:
                        <strong>
                            {{Carbon\Carbon::parse($warranty['created_at'])->addMonths($warranty['warrantyType']['duration'])->format('d-m-Y')}}
                        </strong>
                    @elseif(isset($warranty['case']) && $warranty['case'] == 2)
                        Thời hạn bảo hành theo ngày sản xuất:
                        <strong>
                            {{Carbon\Carbon::parse($warranty['created_at'])->addMonths($warranty['warrantyType']['duration'])->format('d-m-Y')}}
                        </strong>
                    @else
                        Thời hạn bảo hành:
                        <strong>
                            {{\App\Helpers\AppHelper::calculateExpiredAtFromWarranty($warranty['id'])}}
                        </strong>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
