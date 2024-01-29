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
{{--                </div>--}}
{{--                    Ngày kích hoạt--}}
{{--                    @if(isset($warranty['delivery']) && $warranty['delivery'])--}}
{{--                        (nhận hàng)--}}
{{--                    @endif--}}
{{--                    :--}}
{{--                        <strong>--}}
{{--                            {{ date('d-m-Y', strtotime($warranty['created_at'])) }}--}}
{{--                        </strong>--}}
{{--                </div>--}}
                </div>
                    Thời hạn bảo hành:
                    @if(isset($warranty['delivery']) && $warranty['delivery'])
                        <strong>
                            {{Carbon\Carbon::parse($warranty['created_at'])->addMonths($warranty['warrantyType']['duration'])->format('d-m-Y')}}
                        </strong>
                    @else
                        <strong>
                            {{\App\Helpers\AppHelper::calculateExpiredAtFromWarranty($warranty['id'])}}
                        </strong>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
