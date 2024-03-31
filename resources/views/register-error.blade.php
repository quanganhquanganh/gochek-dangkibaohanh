@extends('layout')

@section('content')
    <div class="w-full bg-background py-20 flex">
        <div class="w-[680px] mx-auto  flex flex-col justify-between items-center bg-white text-lg p-4 rounded-xl">
            <div class="">
                <img src="{{ asset('error.png') }}" class=" mx-auto">
            </div>
            <div class="text-[25px] md:text-[40px] font-bold py-5 text-center">
                ĐĂNG KÝ KHÔNG THÀNH CÔNG!
            </div>
            <div class="text-[22px] font-bold py-4 text-center">
                Hiện tại trên hệ thống không có
                <br class="inline md:hidden">
                dữ kiện về thời gian bảo hành cho
                <br class="inline md:hidden">
                sản phẩm này.
            </div>
            <div class="text-[15px] text-center">
                Quý khách vui lòng liên hệ hotline:
                <strong>
                    097 702 1884
                </strong>
                hoặc
                <strong>
                    033 909 6822
                </strong>
                để được hỗ trợ
            </div>
        </div>
    </div>
@endsection
