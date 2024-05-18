<x-app.admin.main-container>
    <x-app.page-header :show_back_btn="true" :back_btn_url="route('document-guide.index')" />

    <x-card class="px-6 py-5 flex flex-col gap-y-5">
        <div class="card-title">
            <h1 class="font-bold text-2xl">{{ $guide->name }} - Edit</h1>
        </div>
        <form action="{{ route('admin.guides.update', $guide->id) }}" method="post" class="flex flex-col gap-y-4">
            @csrf
            @method('PATCH')

            <div>
                <span class="block font-fs font-semibold text-sm uppercase">Description</span>

                <div class="mt-1 flex flex-col gap-y-2">
                    <x-form.quill-editor :content="$guide->description" :input_name="__('description')" />
                </div>
            </div>

            <div>
                <x-primary-button>Save</x-primary-button>
            </div>
        </form>
    </x-card>
</x-app.admin.main-container>
