@extends('layout')

@section('content')
    <div class="w-full bg-background md:py-10 lg:py-20 flex">
        <div class="w-[680px] mx-auto  flex flex-col justify-between items-center bg-white text-lg p-4 rounded-xl">
            <div class="text-[30px] md:text-[40px] font-bold py-5">
                KẾT QUẢ TRA CỨU
            </div>
            @foreach($warranties as $warranty)
                <div class="w-full p-4 border-b border-gray-200">
                <div class="text-lg">Tên sản phẩm: <strong>{{ $warranty['warrantyType']['name'] }}</strong></div>
                <div class="text-lg">Thời hạn bảo hành: <strong>{{ $warranty['warrantyType']['duration'] }} tháng</strong></div>
                <div class="text-lg">Ngày kích hoạt: <strong>{{ date('d-m-Y', strtotime($warranty['created_at'])) }}</strong></div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
