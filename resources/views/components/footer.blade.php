{{--Footer--}}
<div class="w-full bg-background px-4 md:px-0">
    <div class="w-full sm:w-[960px] mx-auto flex flex-col  items-start text-white text-lg pt-10">
        <div class="">
            <img src="{{ asset('text-logo.png') }}" class="w-[150px] mx-auto">
        </div>
        <div class="flex flex-col text-sm mt-6">
            <div class="flex items-center">
                @include('components.icon.home', ['fill' => '#fff'])
                <span class="ml-2">Cửa hàng Đại lý Ủy quyền: 501 Nguyễn Trãi, Thanh Xuân Nam, Thanh Xuân, Hà Nội</span>
            </div>
            <div class="mt-3 flex items-center">
                @include('components.icon.phone', ['fill' => '#fff'])
                <span class="ml-3">Hotline: 097 702 1884</span>
            </div>
            <div class="mt-3 flex items-center">
                @include('components.icon.email', ['fill' => '#fff'])
                <span class="ml-3">Email: gochekvn@gmail.com</span>
            </div>
            <div class="mt-3 flex items-center">
                @include('components.icon.global', ['fill' => '#fff'])
                <span class="ml-3">Website: http://gochek.com.vn</span>
            </div>
        </div>

        <div class="w-full h-px bg-[#36383f] mt-8 mb-8"></div>
    </div>
</div>
