<aside
    class="relative h-screen w-64 bg-primary font-fs text-base-100 xl:w-80 hidden sm:block overflow-y-auto border-r border-r-gray-300 shadow-sm">
    <!-- Organization Logo -->
    <div class="p-6 flex flex-col gap-y-2 items-center">
        <a href="/home">
            <img src="{{ asset('images/shssn-logo.png') }}" class="w-16 aspect-square"
                alt="Manuela Homes Homeowners Association Logo">
        </a>
        <span class="font-semibold text-xs text-center">SHS in San Nicolas III, City of Bacoor, Cavite</span>
    </div>

    <nav class="px-2.5 flex flex-col gap-y-1 text-base font-semibold">
        {{ $slot }}
    </nav>
</aside>
