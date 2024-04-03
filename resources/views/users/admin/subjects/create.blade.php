<x-app.admin.main-container>
    <x-app.page-header :show_back_btn="true" :back_btn_url="route('admin.subjects.index')" />

    <x-card class="px-6 py-5 flex flex-col gap-y-5">
        <div class="card-title">
            <h1 class="font-bold text-2xl">Subject - Create</h1>
        </div>
        <form action="{{ route('admin.subjects.store') }}" method="post" class="flex flex-col gap-y-4">
            @csrf

            <div>
                <x-form.input-label for="name" :value="__('Name')" />

                <x-form.text-input id="name" class="block mt-1 w-full" type="text" name="name"
                    value="{{ old('name') }}" required autocomplete="current-password"
                    placeholder="Enter the subject name" />

                <x-form.input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-primary-button>Create</x-primary-button>
            </div>
        </form>
    </x-card>
</x-app.admin.main-container>
