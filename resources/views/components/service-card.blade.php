@props(['href' => '#'])

<div class="bg-primary h-[1000px] max-h-20 overflow-hidden">
    <h2 class="relative z-10 peer h-full font-bold text-lg text-base-100">
        <a href="{{ $href }}" class="group relative h-full px-5 py-4 flex flex-col justify-end">
            {{ $slot }}
            <div
                class="z-0 absolute right-0 top-2 transition ease-in-out duration-150 opacity-30 group-hover:opacity-45">
                <img src="{{ asset('images/shssn-logo.png') }}" class="z-0 w-28 aspect-square" alt="">
            </div>
        </a>
    </h2>
</div>
