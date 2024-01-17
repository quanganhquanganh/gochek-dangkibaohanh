@extends('layout')


@section('content')
    {{--Main Form--}}
    <div class="w-full bg-background text-white">
        <div class="w-full sm:w-[960px] mx-auto grid sm:grid-cols-2">
            <div class="row-span-1">
            <div class="text-[20px] sm:text-[40px] font-bold py-10 text-center sm:text-left">
                    TRA CỨU
                    <br>
                    BẢO HÀNH
                </div>
                <span class="">
                <div class="text-center sm:text-left">
                    Kiểm tra trạng thái bảo hành của sản phẩm
                </div>
            </span>
            </div>
            <div class="row-span-1 p-5 py mb-12">
                <form class="rounded-md text-black bg-[#454545] px-5 py-5" action="{{ route('warranty-search') }}" method="POST">
                    @csrf
                    <div class="text-white text-lg my-1">Vui lòng điền một trong hai trường dưới đây</div>
                    <input type="text" name="phone" placeholder="Số điện thoại" class="w-full px-5 py-3 my-2 bg-white">
                    <input type="text" name="warranty_code" placeholder="Mã bảo hành" class="w-full px-5 py-3 my-2 bg-white">
                    <div class="flex justify-between mt-8 mb-2">
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
    <div class="w-full bg-white text-black">
        <div class="w-full sm:w-[960px] mx-auto flex flex-col items-center">
            <div class="text-[20px] sm:text-[35px] font-bold pt-5 pb-3 text-center">
                VỊ TRÍ MÃ BẢO HÀNH
            </div>
            <div class="w-1/5 border-b border-dashed border-[#36383f] mb-4"></div>
            <span class="font-bold text-[22px]">
            Mã bảo hành được in trên Thẻ bảo hành
        </span>
        <span class="text-[14px]">
            (Mỗi một sản phẩm có một mã bảo hành riêng)
        </span>
        <div class="mt-10 mb-10 flex justify-around relative"> <!-- Add relative here -->
            <div id="rectangle-box" 
                class="absolute top-[85%] left-[65%] w-[28%] h-[10%] border-2 border-solid border-red-700">
            </div>
            <div id="IMAGE504"
                class="w-[420.752px] h-[240.155px]
                bg-no-repeat bg-top bg-cover bg-scroll bg-content-box
                pointer-events-none"
                style="background-image: url('https://w.ladicdn.com/s750x550/5ac37fb5e9cb7e9e17437a81/the-bao-hanh-3-20230906021458-9bxxo.png');">
            </div>
        </div>
    </div> 
        </div>
    </div>
    {{--End Tutorial Box--}}
@endsection
