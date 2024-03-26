@if (session('message'))
    {{-- x-init executes a function when it initializes --}}
    <div x-data ="{ show: true }" x-init="setTimeout(() => show = false, 6000)" x-transition.duration.500ms x-cloak x-show="show"
        class="z-50 fixed top-10 left-1/2 transform -translate-x-1/2 bg-black/80 text-white text-center px-32 py-3">
        <p>
            {{ session('message') }}
        </p>
    </div>
@endif
