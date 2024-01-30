@extends('layout')

@section('content')
    <div class="w-full bg-background py-20 flex">
        <div class="w-[680px] mx-auto  flex flex-col justify-between items-center bg-white text-lg p-4 rounded-xl">
            <div class="">
                @include('components.icon.success')
            </div>
            <div class="text-[25px] md:text-[40px] font-bold py-5">
                ĐĂNG KÝ THÀNH CÔNG!
            </div>
            <div class="text-[22px] font-bold py-4">
                CẢM ƠN BẠN ĐÃ ĐĂNG KÝ BẢO HÀNH ĐIỆN TỬ
            </div>
            <div class="text-[15px]">
                Quý khách có thể tra cứu thời hạn bảo hành tại
                <a
                    class="underline cursor-pointer text-blue-700 hover:text-blue-900"
                    href="{{route('search')}}"
                >Tra cứu bảo hành</a>
            </div>
        </div>
    </div>
@endsection
