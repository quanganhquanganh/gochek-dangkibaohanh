{{--Chuyen Tab --}}
<div class="w-full bg-black text-white bg-[left_-10px_bottom_-200px] bg-no-repeat"
     style="background-image: url('{{ asset('tab-bg.png') }}')">
    <div class="w-[960px] mx-auto py-24">
        <div class="text-[51px] font-bold text-center py-10">BẢO HÀNH ĐIỆN TỬ GOCHEK</div>
        <div class="flex text-lg justify-around font-bold">
            <a class="cursor-pointer border border-solid border-white px-5 py-3 rounded-2xl @if (request()->routeIs('home')||request()->routeIs('success')) active @endif"
                href="{{route('home')}}"
            >
                KÍCH HOẠT BẢO HÀNH
            </a>
            <div class="cursor-pointer border border-solid border-white px-5 py-3 rounded-2xl">
                TRA CỨU BẢO HÀNH
            </div>
            <div class="cursor-pointer border border-solid border-white px-5 py-3 rounded-2xl">
                CHÍNH SÁCH BẢO HÀNH
            </div>
        </div>
    </div>
</div>
{{--End Chuyen Tab --}}
