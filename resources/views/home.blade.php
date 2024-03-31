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
        <div class="w-full lg:w-[960px] mx-auto grid lg:grid-cols-2 sm:pt-4 sm:pb-4">
            <div class="row-span-1 px-4 sm:px-0">
                <div class="text-[20px] lg:text-[40px] font-bold py-5 lg:py-10 text-center lg:text-left">
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
                <form class="rounded-md text-black bg-[#454545] px-5 py-5" action="{{ route('baohanh.store') }}" method="POST">
                    @csrf
                    <div class="text-white text-lg my-1">Vui lòng điền đầy đủ các thông tin sau</div>
                    <input type="text" name="user_name" placeholder="Họ và tên" class="w-full px-3 py-3 my-2 bg-white" required >
                    <input type="text" name="phone" placeholder="Số điện thoại" class="w-full px-3 py-3 my-2 bg-white" required
                           minlength="10" maxlength="11" pattern="[0-9]+">
                    <input type="email" name="email" placeholder="Email" class="w-full px-3 py-3 my-2 bg-white" >
{{--                    <input type="text" name="warranty_code" placeholder="Mã bảo hành" class="w-full px-3 py-3 my-2 bg-white" required oninvalid="this.setCustomValidity('Vui lòng điền đầy đủ thông tin để kích hoạt bảo hành.')">--}}
                    <select name="product_name" class="w-full px-3 py-3 my-2 bg-white" required >
                        <option value="" selected disabled>Tên sản phẩm</option>
                        @foreach($products as $product)
                            <option value="{{ $product->name }}">{{ $product->name }}</option>
                        @endforeach
                    </select>

                    <select name="store_name" class="w-full px-3 py-3 my-2 bg-white" required >
                        <option value="" selected disabled>Nơi mua</option>
                        <option value="Cửa hàng Đại lý Ủy quyền">Mua trực tiếp</option>
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
                        <a href="https://zalo.me/0977021884"
                        class="bg-white px-3 py-1 text-[rgb(23, 23, 23)] font-bold rounded-full pulse flex items-center justify-between"
                        target="_blank">
                            <span class="hidden sm:block">
                                Hỗ trợ ngay
                            </span>
                            <img src="https://toyotatancangsaigon.vn/wp-content/uploads/2019/08/zalo-icon.png" class="sm:ml-3 w-[40px] h-[40px]" alt="Messenger Icon" />
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--End Main Form--}}

    {{--Tutorial Box--}}
{{--    @include('components.tutorial-box')--}}
    {{--End Tutorial Box--}}
@endsection
