<x-app.admin.main-container>
    <main class="w-full flex-grow">
        <x-card class="flex flex-col justify-center items-center gap-y-5 px-6 py-5">
            <div class="flex justify-center">
                <i class="fa-solid fa-circle-check text-5xl text-success"></i>
            </div>

            <h1 class="text-center text-2xl font-bold">Link generated successfully</h1>

            <p class="text-center">Make sure to <strong>write down</strong> the URL or <strong>copy</strong> it by
                <strong>clicking the copy <i class="fa-regular fa-copy"></i> button</strong>.
            </p>

            <p class="text-center">Take note that the link will expire in 48 hours upon its generation.</p>

            <div class="flex justify-between items-center gap-x-4">
                <div><span class="font-semibold">URL:</span> <span class="text-secondary">{{ $link->url }}</span>
                </div>
                <div x-data="copyTextBtn('{{ $link->url }}')" class="relative z-20 flex items-center">
                    <div x-show="copyNotification" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-x-2"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 translate-x-0"
                        x-transition:leave-end="opacity-0 translate-x-2" class="absolute left-0" x-cloak>
                        <div
                            class="px-3 h-7 -ml-1.5 items-center flex text-xs bg-green-500 border-r border-green-500 -translate-x-full text-white rounded">
                            <span>Copied!</span>
                            <div
                                class="absolute right-0 inline-block h-full -mt-px overflow-hidden translate-x-3 -translate-y-2 top-1/2">
                                <div
                                    class="w-3 h-3 origin-top-left transform rotate-45 bg-green-500 border border-transparent">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button @click="copyToClipboard();"
                        class="flex items-center justify-center h-8 bg-white border rounded-md cursor-pointer w-9 border-gray-300 hover:bg-gray-100 active:bg-white focus:bg-white focus:outline-none group">
                        <svg x-show="copyNotification" class="w-4 h-4 text-green-500 stroke-current"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" x-cloak>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        <i x-cloak x-show="!copyNotification" class="fa-regular fa-copy"></i>
                    </button>
                </div>

                {{-- <button class="btn btn-sm btn-accent"><i class="fa-regular fa-copy"></i>Copy</button> --}}
            </div>

            <div>
                <a href="{{ route('admin.registration-links.index') }}" class="btn btn-accent font-fs uppercase">Go
                    back</a>
            </div>
        </x-card>
    </main>
</x-app.admin.main-container>
