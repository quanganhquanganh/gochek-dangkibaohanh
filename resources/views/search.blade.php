@extends('layout')


@section('content')
    {{--Main Form--}}
    <div class="w-full bg-background text-white">
        <div class="w-full lg:w-[960px] mx-auto grid lg:grid-cols-2 sm:pt-16 sm:pb-28">
            <div class="row-span-1">
            <div class="text-[20px] lg:text-[40px] font-bold py-5 lg:py-10  text-center lg:text-left">
                    TRA CỨU
                    <span class="hidden lg:inline"><br></span>
                    BẢO HÀNH
                </div>
                <span class="">
                <div class="text-center lg:text-left">
                    Kiểm tra trạng thái bảo hành của sản phẩm
                </div>
            </span>
            </div>
            <div class="row-span-1 p-5 py mb-12">
                <form class="rounded-md text-black bg-[#454545] px-5 py-5" action="{{ route('warranty-search') }}" method="POST">
                    @csrf
                    <div class="text-white text-lg my-1">Vui lòng điền một trong hai thông tin dưới đây</div>
                    <input type="text" name="phone" placeholder="Số điện thoại" class="w-full px-5 py-3 my-2 bg-white">
                    <br>
                    <span class="text-white text-sm my-1">Hoặc</span>
                    <br>
                    <input type="text" name="warranty_code" placeholder="Mã bảo hành" class="w-full px-5 py-3 my-2 bg-white">
                    <div class="flex justify-between mt-2 mb-2">
                        <button class="bg-[#962805] px-3 py-4 text-white font-bold text-[15px]" type="submit">
                            Tra cứu bảo hành
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--End Main Form--}}

    {{--Tutorial Box--}}
    @include('components.tutorial-box')
    {{--End Tutorial Box--}}
@endsection
