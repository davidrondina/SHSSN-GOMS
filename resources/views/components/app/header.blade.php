<header class="w-full justify-end items-center bg-white py-1 px-6 hidden shadow sm:flex border-b border-gray-300">
    <x-container class="py-3">
        <div class="flex justify-end items-center">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="inline-flex items-center gap-x-2 btn btn-sm font-fs font-semibold uppercase">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </button>
            </form>
        </div>
    </x-container>
</header>
