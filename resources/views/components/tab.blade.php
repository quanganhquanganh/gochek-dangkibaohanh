{{--Chuyen Tab --}}
<div class="w-full bg-black text-white bg-[left_-10px_bottom_-200px] bg-no-repeat"
     style="background-image: url('{{ asset('tab-bg.png') }}')">
    <div class="w-full lg:w-[960px] mx-auto py-24">
        <div class="text-2xl lg:text-[51px] font-bold text-center py-10">BẢO HÀNH ĐIỆN TỬ GOCHEK</div>
        <div class="px-8 md:px-0 flex flex-col md:flex-row text-lg justify-around font-bold">
            <a class="cursor-pointer border border-solid border-white px-5 py-3 rounded-2xl @if (request()->routeIs('')||request()->routeIs('home')) active @endif mb-4 lg:mb-0"
                href="{{route('home')}}"
            >KÍCH HOẠT BẢO HÀNH</a>
            <a class="cursor-pointer border border-solid border-white px-5 py-3 rounded-2xl @if (request()->routeIs('search')) active @endif mb-4 lg:mb-0"
                href="{{route('search')}}"
            >TRA CỨU BẢO HÀNH</a>
            <a class="cursor-pointer border border-solid border-white px-5 py-3 rounded-2xl"
                href="https://gochek.vn/pages/chinh-sach-bao-hanh"
            >CHÍNH SÁCH BẢO HÀNH</a>
        </div>
    </div>
</div>
{{--End Chuyen Tab --}}
