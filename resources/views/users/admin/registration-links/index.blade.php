@php
    use Carbon\Carbon;
@endphp

<x-app.admin.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('Registration Links')">
            <x-slot name="controls">
                <x-confirm-modal :type="__('warning')">
                    <button @click="open = !open" class="btn btn-sm btn-primary"><i
                            class="fa-solid fa-plus font-normal"></i>Generate
                    </button>

                    <x-slot name="header">
                        Generate Link?
                    </x-slot>
                    <x-slot name="body">
                        <p class="text-gray-500 text-sm">This will generate a one-time link registration form link for
                            the
                            faculty.</p>
                    </x-slot>

                    <x-slot name="action">
                        <form action="{{ route('admin.registration-links.store') }}" method="post" class="flex">
                            @csrf

                            <button class="flex btn btn-primary font-poppins uppercase">Confirm</button>
                        </form>
                    </x-slot>
                </x-confirm-modal>
            </x-slot>
        </x-app.page-header>

        <x-table.wrapper>
            <x-table.head>
                <tr>
                    <x-table.header-cell :scope="__('col')">URL</x-table.header-cell>
                    <x-table.header-cell :scope="__('col')">Expires At</x-table.header-cell>
                    <x-table.header-cell :scope="__('col')">Actions</x-table.header-cell>
                </tr>
            </x-table.head>
            <x-table.body>
                @forelse ($links as $link)
                    <tr class="bg-white border-b">
                        <x-table.header-cell :scope="__('row')">{{ $link->url }}</x-table.header-cell>
                        <x-table.regular-cell>{{ Carbon::parse($link->expires_at)->format('M. d, Y') }}</x-table.regular-cell>
                        <x-table.regular-cell>
                            <div class="flex gap-x-3">
                                <div x-data="copyTextBtn('{{ $link->url }}')" class="relative z-20 flex items-center">
                                    <div x-show="copyNotification" x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 translate-x-2"
                                        x-transition:enter-end="opacity-100 translate-x-0"
                                        x-transition:leave="transition ease-in duration-300"
                                        x-transition:leave-start="opacity-100 translate-x-0"
                                        x-transition:leave-end="opacity-0 translate-x-2" class="absolute left-0"
                                        x-cloak>
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
                                    <button @click="copyToClipboard();" class="btn btn-sm btn-accent">
                                        <svg x-cloak x-show="copyNotification" class="w-4 h-4stroke-current"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" x-cloak>
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.5 12.75l6 6 9-13.5" />
                                        </svg>
                                        <span x-cloak x-show="copyNotification">Copied!</span>
                                        <i x-cloak x-show="!copyNotification" class="fa-regular fa-copy"></i>
                                        <span x-cloak x-show="!copyNotification">Copy</span>
                                    </button>
                                </div>

                                <x-confirm-modal :type="__('warning')">
                                    <button @click="open = !open" class="btn btn-sm btn-error"><i
                                            class="ri-delete-bin-line font-normal"></i>Delete
                                    </button>

                                    <x-slot name="header">
                                        Delete Link?
                                    </x-slot>
                                    <x-slot name="body">
                                        <p class="text-gray-500 text-sm">This action cannot be
                                            undone.</p>
                                    </x-slot>

                                    <x-slot name="action">
                                        <form action="#" method="post" class="flex">
                                            @csrf
                                            @method('DELETE')

                                            <button class="flex btn btn-warning font-poppins uppercase">Confirm</button>
                                        </form>
                                    </x-slot>
                                </x-confirm-modal>
                            </div>
                        </x-table.regular-cell>
                    </tr>
                @empty
                    <tr class="bg-white border-b">
                        <x-table.regular-cell colspan="4" class="text-center">No links
                            found.</x-table.regular-cell>
                    </tr>
                @endforelse
            </x-table.body>
        </x-table.wrapper>

        @unless (count($links) == 0)
            <div class="my-6">
                {{ $links->links() }}
            </div>
        @endunless
    </main>
</x-app.admin.main-container>
