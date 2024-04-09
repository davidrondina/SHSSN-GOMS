@props([
    'maxWidth' => 'sm',
    'icon',
])

@php
    $maxWidth = [
        'sm' => 'w-11/12 max-w-lg',
        'lg' => 'w-11/12 max-w-5xl',
    ][$maxWidth];
@endphp

<div x-data="{ open: false }">
    {{-- The button to open the modal --}}
    {{ $slot }}

    <div x-cloak x-show="open" class="fixed z-50 inset-0 overflow-y-auto text-neutral">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

            <div x-cloak x-show="open" x-transition.duration.opacity.200ms class="fixed inset-0 transition-opacity"
                aria-hidden="true">
                <div class="absolute inset-0 bg-black/40 opacity-75">
                </div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div @click.outside="open = false" x-cloak x-show="open" x-transition.scale.duration.300ms
                class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle {{ $maxWidth }} sm:p-6"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
                    <button @click="open = false" type="button" data-behavior="cancel" class="btn btn-circle btn-sm">
                        <span class="sr-only">Close</span>
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>

                <div class="sm:flex sm:items-start">
                    @if (isset($icon))
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full sm:mx-0 sm:h-10 sm:w-10 text-2xl">
                            <i class="{{ $icon }}"></i>
                        </div>
                    @endif

                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        @isset($header)
                            <h3 class="flex items-center text-lg leading-6 font-semibold" id="modal-headline">
                                {{ $header }}
                            </h3>
                        @endisset

                        @isset($body)
                            <div class="mt-2">
                                {{ $body }}
                            </div>
                        @endisset

                    </div>
                </div>
                <div class="mt-5 sm:mt-4 flex flex-col sm:flex-row-reverse gap-3">
                    @isset($action)
                        {{ $action }}
                    @endisset

                    <button @click="open = false" type="button"
                        class="flex btn uppercase font-poppins font-semibold">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
