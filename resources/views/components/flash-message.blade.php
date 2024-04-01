@if (session()->has('success_message'))
    {{-- x-init executes a function when it initializes --}}
    <div x-data ="{ show: true }" x-init="setTimeout(() => show = false, 6000)" x-cloak x-show="show" x-transition.duration.200ms
        class="z-50 min-w-48 fixed top-10 left-1/2 transform -translate-x-1/2 bg-success flex justify-center items-center gap-x-5 text-center px-6 py-3 rounded-md">
        <i class="fa-solid fa-circle-check"></i>
        <span>
            {{ session('success_message') }}
        </span>
    </div>
@endif

@if (session()->has('error_message'))
    {{-- x-init executes a function when it initializes --}}
    <div x-data ="{ show: true }" x-init="setTimeout(( => show = false, 6000)" x-cloak x-show="show" x-transition.duration.200ms
        class="z-50 min-w-48 fixed top-10 left-1/2 transform -translate-x-1/2 bg-error flex justify-center items-center gap-x-5 text-center px-6 py-3 rounded-md">
        <i class="fa-solid fa-circle-exclamation"></i>
        <span>
            {{ session('error_message') }}
        </span>
    </div>
@endif

@if (session()->has('warning_message'))
    {{-- x-init executes a function when it initializes --}}
    <div x-data ="{ show: true }" x-init="setTimeout(() => show = false, 6000)" x-cloak x-show="show" x-transition.duration.200ms
        class="z-50 min-w-48 fixed top-10 left-1/2 transform -translate-x-1/2 bg-warning flex justify-center items-center gap-x-5 text-center px-6 py-3 rounded-md">
        <i class="fa-solid fa-triangle-exclamation"></i>
        <span>
            {{ session('warning_message') }}
        </span>
    </div>
@endif

@if (session()->has('info_message'))
    {{-- x-init executes a function when it initializes --}}
    <div x-data ="{ show: true }" x-init="setTimeout(() => show = false, 6000)" x-cloak x-show="show" x-transition.duration.200ms
        class="z-50 min-w-48 fixed top-10 left-1/2 transform -translate-x-1/2 bg-info flex justify-center items-center gap-x-5 text-center px-6 py-3 rounded-md">
        <i class="fa-solid fa-circle-info"></i>
        <span>
            {{ session('info_message') }}
        </span>
    </div>
@endif
