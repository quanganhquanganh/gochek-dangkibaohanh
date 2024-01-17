@extends('layout')

@section('content')
    {{--Main Form--}}
    <div class="w-full bg-background text-white">
        <style>
            @keyframes pulse {
                0% {
                    transform: scale(1);
                }
                50% {
                    transform: scale(1.1);
                }
                100% {
                    transform: scale(1);
                }
            }

            a.pulse {
                animation: pulse 1s infinite;
            }
        </style>
        <div class="w-full lg:w-[960px] mx-auto grid lg:grid-cols-2 sm:pt-12 sm:pb-28">
            <div class="row-span-1 px-4 sm:px-0">
                <div class="text-[20px] lg:text-[40px] font-bold py-10 text-center lg:text-left">
                    KÍCH HOẠT
                    <span class="hidden lg:inline"><br></span>
                    BẢO HÀNH
                    <span class="hidden lg:inline"><br></span>
                    ĐIỆN TỬ
                </div>
                <span class="">
                    <div class="text-center lg:text-left">
                        Quý khách kích hoạt bảo hành điện tử 
                        <span class="hidden lg:inline"><br></span>
                        ngay sau khi mua hàng để đảm bảo 
                        <span class="hidden lg:inline"><br></span>
                        nhận được quyền lợi tối đa
                    </div>
                </span>
            </div>
            <div class="row-span-1 p-5">
                <form class="rounded-md text-black bg-[#454545] px-5 py-5" action="{{ route('warranty-check') }}" method="POST">
                    @csrf
                    <div class="text-white text-lg my-1">Vui lòng điền đầy đủ các thông tin sau</div>
                    <input type="text" name="name" placeholder="Họ và tên" class="w-full px-3 py-3 my-2 bg-white" required oninvalid="this.setCustomValidity('Vui lòng điền đầy đủ thông tin để kích hoạt bảo hành.')">
                    <input type="text" name="phone" placeholder="Số điện thoại" class="w-full px-3 py-3 my-2 bg-white" required oninvalid="this.setCustomValidity('Vui lòng điền đầy đủ thông tin để kích hoạt bảo hành.')">
                    <input type="text" name="warranty_code" placeholder="Mã bảo hành" class="w-full px-3 py-3 my-2 bg-white" required oninvalid="this.setCustomValidity('Vui lòng điền đầy đủ thông tin để kích hoạt bảo hành.')">
                    <select name="store" class="w-full px-3 py-3 my-2 bg-white" required oninvalid="this.setCustomValidity('Vui lòng điền đầy đủ thông tin để kích hoạt bảo hành.')">
                        <option value="Cửa hàng Đại lý Ủy quyền" selected>Cửa hàng đại lý ủy quyền</option>
                        <option value="Facebook">Facebook</option>
                        <option value="TikTok Shop">Tiktok Shop</option>
                        <option value="Shopee">Shopee</option>
                        <option value="Lazada">Lazada</option>
                        <option value="Website">Website</option>
                    </select>
                    <div class="flex justify-between mt-3 ">
                        <button class="bg-[#962805] px-3 py-1 text-white font-bold leading-10" type="submit">
                            Kích hoạt bảo hành ngay
                        </button>
                        <a href="https://www.messenger.com/t/gochekvietnamofficial"
                        class="bg-white px-3 py-1 text-[rgb(23, 23, 23)] font-bold rounded-full pulse flex items-center justify-between"
                        target="_blank">
                            <span class="hidden sm:block">
                                Liên Hệ Ngay
                            </span>
                            <img src="https://w.ladicdn.com/ladiui/icons/social/messenger.svg" class="sm:ml-3 w-[40px] h-[40px]" alt="Messenger Icon" />
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--End Main Form--}}

    {{--Tutorial Box--}}
    <div class="w-full bg-white text-black">
        <div class="w-full lg:w-[960px] mx-auto flex flex-col items-center">
            <div class="text-[20px] lg:text-[35px] font-bold pt-5 pb-3 text-center">
                VỊ TRÍ MÃ BẢO HÀNH
            </div>
            <div class="w-1/4 border-b border-dashed border-[#c2c5d1] mb-4"></div>
            <span class="font-bold text-[22px]">
            Mã bảo hành được in trên Thẻ bảo hành
        </span>
        <span class="text-[14px]">
            (Mỗi một sản phẩm có một mã bảo hành riêng)
        </span>
        <div class="mt-10 mb-10 grid lg:grid-cols-2 gap-0">
            <div id="IMAGE504"
                class="w-[420.752px] h-[240.155px] relative
                bg-no-repeat bg-top bg-cover bg-scroll bg-content-box
                pointer-events-none"
                style="background-image: url('https://w.ladicdn.com/s750x550/5ac37fb5e9cb7e9e17437a81/the-bao-hanh-3-20230906021458-9bxxo.png');">
                <div id="rectangle-box" 
                    class="absolute top-[84%] left-[65%] w-[28%] h-[12%] border-2 border-solid border-[#bb3003] py-2">
                </div>
            </div>

            <div class="hidden md:flex flex-col items-center relative" id="tutorial-box">
                <div class="absolute top-[70%] left-[-9%]  w-1/2 rotate-[-25deg] border border-solid border-[#bb3003]"></div>
                <div class="cursor-pointer z-10 mt-24 ml-5 w-[160px] h-[40px] bg-[#f8b349] flex justify-center items-center text-black font-[900] text-[20px]">
                    Mã bảo hành
                </div>
            </div>
        </div>
    </div> 
        </div>
    </div>
    {{--End Tutorial Box--}}
@endsection
