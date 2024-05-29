<header class="z-30 sticky top-0 left-0 bg-primary text-base-100 font-fs">
    <x-container class="container mx-auto hidden md:flex flex-wrap px-5 py-3 flex-col md:flex-row items-center">
        <a href="/" class="flex title-font font-medium items-center mb-4 md:mb-0">
            <img src="{{ asset('images/shssn-logo.png') }}" alt=""
                class="w-12 aspect-square object-cover rounded-full border border-white">
        </a>
        <nav class="md:ml-auto flex flex-wrap items-center gap-x-6 mr-6 font-semibold text-base justify-center">
            <a href="{{ route('guest.services') }}" class="hover:text-neutral">Services</a>
            <a href="{{ route('login') }}" class="hover:text-neutral">Login</a>
        </nav>
        <a href="{{ route('register') }}" class="btn btn-accent btn-sm">Register
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                <path d="M5 12h14M12 5l7 7-7 7"></path>
            </svg>
        </a>
    </x-container>
</header>

<header x-data="{ open: false }" class="z-30 sticky top-0 left-0 flex flex-col md:hidden text-base-100 font-fs">
    <div class="bg-primary">
        <x-container class="container mx-auto px-5 py-3 flex justify-between items-center">
            <a href="/" class="flex title-font font-medium items-center">
                <img src="{{ asset('images/shssn-logo.png') }}" alt="SHSSN3 Logo"
                    class="w-12 aspect-square object-cover rounded-full border border-white">
            </a>

            <div>
                <button @click="open = !open" class="p-4 text-2xl flex items-center">
                    <i :class="open ? 'fa-solid fa-times' : 'fa-solid fa-bars'"></i>
                </button>
            </div>
        </x-container>
    </div>

    <div x-cloak x-show="open" x-transition.duration.200ms class="w-full h-screen bg-white px-5 py-9 shadow-md">
        <div class="container font-bold flex flex-col gap-y-4 divide-y-2 divide-gray-300">
            <div class="uppercase text-neutral text-center text-sm">SHS in San Nicholas III, Bacoor City - Guidance
                Office</div>
            <ul class="flex flex-col justify-start gap-y-4 text-xl text-neutral">
                <li><a href="{{ route('guest.services') }}" class="flex gap-x-2 w-full px-4 py-6 rounded-md">Services<i
                            class="ri-arrow-right-up-line"></i></a></li>
                <li><a href="{{ route('login') }}" class="flex gap-x-2 w-full px-4 py-6 rounded-md">Login<i
                            class="ri-arrow-right-up-line"></i></a></li>
                <li><a href="{{ route('register') }}"
                        class="flex gap-x-2 w-full bg-accent px-4 py-6 rounded-md">Register<i
                            class="ri-arrow-right-up-line"></i></a></li>
            </ul>
        </div>
    </div>
</header>
