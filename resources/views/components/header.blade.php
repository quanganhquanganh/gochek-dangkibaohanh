<div class="w-full bg-background">
    <div class="w-full lg:w-[960px] mx-auto  flex justify-between items-center text-white text-lg p-2 md:p-4">
        <a class="" href="{{ route('home') }}">
            <img src="{{ asset('logo.png') }}" class="w-[150px] mx-auto hidden lg:block">
            <img src="{{ asset('text-logo.png') }}" class="w-[150px] mx-auto lg:hidden">
        </a>
        <div class="flex flex-col text-xs lg:text-base">
            <span class="font-bold">HOTLINE</span>
            <div class="flex items-center">
                @include('components.icon.phone', ['fill' => '#fff'])
                <span class="ml-2">097 702 1884 (Tiktok, Shoppe)</span>
            </div>
            <div class="flex items-center">
                @include('components.icon.phone', ['fill' => '#fff'])
                <span class="ml-2">0339 096 822 (Website, Facebook, Mua trực tiếp)</span>
            </div>
        </div>
    </div>
</div>
