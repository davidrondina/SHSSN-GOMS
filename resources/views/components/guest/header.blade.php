<header class="z-30 sticky top-0 left-0 bg-primary text-base-100 font-fs">
    <x-container class="container mx-auto flex flex-wrap px-5 py-5 flex-col md:flex-row items-center">
        <a href="/" class="flex title-font font-medium items-center mb-4 md:mb-0">
            <img src="{{ asset('images/shssn-logo.png') }}" alt=""
                class="w-10 aspect-square object-cover rounded-full border border-white">
        </a>
        <nav class="md:ml-auto flex flex-wrap items-center gap-x-6 mr-6 font-semibold text-base justify-center">
            <a href="#" class="hover:text-neutral">Services</a>
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
