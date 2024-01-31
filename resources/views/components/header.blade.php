<div class="w-full bg-background">
    <div class="w-full lg:w-[960px] mx-auto  flex justify-between items-center text-white p-2 md:p-4">
        <a class="" href="{{ route('home') }}">
            <img src="{{ asset('logo.png') }}" class="w-[150px] mx-auto hidden lg:block">
            <img src="{{ asset('text-logo.png') }}" class="w-[120px] mx-auto lg:hidden">
        </a>
        <div class="flex flex-col text-[8px] md:text-base gap-0 lg:gap-2">
            <span class="font-bold">HOTLINE</span>
            <div class="flex items-center">
                <div class="hidden md:block">
                    @include('components.icon.phone', ['fill' => '#fff'])
                </div>
                <div class="block md:hidden">
                    @include('components.icon.small-phone', ['fill' => '#fff'])
                </div>
                <span class="ml-2">097 702 1884 (TikTok, Shopee)</span>
            </div>
            <div class="flex items-center">
                <div class="hidden md:block">
                    @include('components.icon.phone', ['fill' => '#fff'])
                </div>
                <div class="block md:hidden">
                    @include('components.icon.small-phone', ['fill' => '#fff'])
                </div>
                <span class="ml-2">033 909 6822 (Website, Facebook, Mua trực tiếp)</span>
            </div>
        </div>
    </div>
</div>
