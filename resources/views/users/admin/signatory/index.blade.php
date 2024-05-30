<x-app.admin.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('Signatories')" />

        @unless (count($signatories) == 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-sm">
                @foreach ($signatories as $sig)
                    <div class="bg-white h-fit p-4 flex flex-col gap-y-2">
                        <div class="flex justify-between items-center">
                            <div class="flex flex-col gap-y-1">
                                <span class="font-semibold text-base">{{ $sig->name }}</span>
                                <span class="text-sm text-neutral-700">{{ $sig->position }}</span>
                            </div>
                            <div class="tooltip" data-tip="Edit">
                                <a href="{{ route('admin.signatory.edit', $sig->id) }}" class="text-primary"><i
                                        class="fa-solid fa-edit"></i></a>
                            </div>
                        </div>
                        <div class="flex flex-col gap-y-2">
                            <div class="h-60 aspect-square border border-gray-300 overflow-hidden">
                                <a href="{{ asset('storage/' . $sig->signature_image) }}" class="venobox block">
                                    <img src="{{ asset('storage/' . $sig->signature_image) }}" alt=""
                                        class="object-cover object-center">
                                </a>
                            </div>

                            <div class="badge badge-primary">{{ $sig->type }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center">No feedback found.</p>
        @endunless
    </main>

    @push('js')
        <script defer>
            const venobox = new VenoBox({
                selector: '.venobox',
                spinner: 'circle-fade',
            });
        </script>
    @endpush
</x-app.admin.main-container>
