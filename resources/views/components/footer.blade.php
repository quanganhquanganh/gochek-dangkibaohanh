{{-- Footer --}}
<div class="w-full bg-background px-4 md:px-0">
    <div class="w-full sm:w-[960px] mx-auto flex flex-col  items-start text-white text-lg pt-10">

        @if (request()->routeIs('warranty-search'))
            <div class="w-full h-px bg-[#36383f] mt-8 mb-8"></div>
        @endif

        <div class="">
            <img src="{{ asset('text-logo.png') }}" class="w-[150px] mx-auto">
        </div>
        <div class="flex flex-col text-sm mt-6">
            <div class="flex items-center">
                @include('components.icon.home', [
                    'fill' => '#fff',
                    'class' => 'hidden md:block self-start',
                ])
                @include('components.icon.small-screen-home', [
                    'fill' => '#fff',
                    'class' => 'block md:hidden self-start',
                ])
                <span class="ml-2">Cửa hàng Đại lý Ủy quyền: 501 Nguyễn Trãi, Thanh Xuân Nam, Thanh Xuân, Hà Nội</span>
            </div>
            {{--
            <div class="mt-3 flex items-center">
                @include('components.icon.phone', ['fill' => '#fff'])
                <span class="ml-3">Hotline:
                    <a href="tel:0977021884" class="underline">037 235 4208</a>
                </span>
            </div>
            --}}
            <div class="mt-3 flex items-center">
                @include('components.icon.email', ['fill' => '#fff'])
                <span class="ml-3">Email:
                    <a href="mailto:gochekvn@gmail.com" class="underline">
                        gochekvn@gmail.com
                    </a>
                </span>
            </div>
            <div class="mt-3 flex items-center">
                @include('components.icon.global', ['fill' => '#fff'])
                <span class="ml-3">Website:
                    <a href="https://gochek.vn" class="underline">http://gochek.vn</a>
                </span>
            </div>
            <div class="mt-3 flex items-center">
                <span class="ml-3">
                    Xem thêm các sản phẩm: micro, gimbal, tai nghe, gậy chụp ảnh,... tại:
                    <a href="https://gochek.vn" class="underline">(Link Tất cả sản phẩm của trang web GoChek)</a>
                </span>
            </div>
        </div>
            <div class="w-full h-px bg-[#36383f] mt-8 mb-8"></div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6 w-full mb-8">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('products/livepro-g1.png') }}"
                         alt="Image" class="w-full  object-cover">
                </div>
                <!-- <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('products/spacexs-1000.png') }}"
                         alt="Image" class="w-full  object-cover">
                </div> -->
                <!-- Box 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('products/gochekultras25.png') }}"
                         alt="Image" class="w-full  object-cover">
                </div>
                <!-- Box 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('products/ultra24.jpg') }}"
                         alt="Image" class="w-full object-cover">
                </div>
                <!-- Box 3 -->
                <!-- <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('products/hh24.webp') }}"
                         alt="Image" class="w-full object-cover">
                </div> -->
                <!-- Box 4 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('products/tainghespacex.jpg ') }}"
                         alt="Image" class="w-full object-cover">
                </div>
                <!-- Box 5 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('products/gocheks100.jpg') }}"
                         alt="Image" class="w-full object-cover">
                </div>
                <!-- Box 6 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('products/ultraplus.jpg') }}"
                         alt="Image" class="w-full object-cover">
                </div>
                <!-- Box 7 -->
                <!-- <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('products/cusaca9.webp') }}"
                         alt="Image" class="w-full object-cover">
                </div> -->
            </div>
    </div>
</div>
