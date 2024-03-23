<section class="bg-black/40 text-base-100">
    <x-container class="mx-auto flex items-center justify-center flex-col">
        <img class="w-40 aspect-square mb-10 object-cover object-center rounded" alt="hero"
            src="{{ asset('images/shssn-logo.png') }}">
        <header class="text-center lg:w-2/3 w-full">
            <h1 class="font-semibold text-lg uppercase">Senior High School in San Nicolas III, City of Bacoor, Cavite
            </h1>
            <p class="font-fs mb-8 text-4xl tracking-wider font-bold leading-relaxed uppercase">Guidance Office
                Management
                System</p>
            <div class="flex justify-center gap-x-8">
                <a href="{{ route('login') }}" class="btn btn-accent uppercase font-semibold font-fs">Login</a>
                <a href="#" class="btn btn-secondary uppercase font-semibold font-fs">Services</a>
            </div>
        </header>
    </x-container>
</section>
