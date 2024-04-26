<header class="w-full justify-end items-center bg-white py-1 px-6 hidden shadow sm:flex border-b border-gray-300">
    <x-container class="py-3 grid grid-cols-2 gap-x-5">
        <div>
            @if (Auth::user()->hasRole('faculty'))
                <x-form.search-form :form_action="route('faculty.students.index')" :placeholder="__('Search student')" />
            @endif
        </div>
        <div class="flex justify-end items-center">
            <form action="{{ route('logout') }}" method="post" class="flex justify-end">
                @csrf
                <button class="inline-flex items-center gap-x-2 btn btn-sm font-fs font-semibold uppercase">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </button>
            </form>
        </div>
    </x-container>
</header>
