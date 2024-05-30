<x-app.admin.main-container>
    <x-app.page-header :show_back_btn="true" :back_btn_url="route('admin.signatory.index')" />

    <x-card class="px-6 py-5 flex flex-col gap-y-5">
        <div class="card-title">
            <h1 class="font-bold text-2xl">Signatory - Edit</h1>
        </div>
        <form action="{{ route('admin.signatory.update', $sig->id) }}" method="post" enctype="multipart/form-data"
            class="flex flex-col gap-y-4">
            @csrf
            @method('PATCH')

            <div x-data="imagePreview" class="flex flex-col gap-y-2">
                <span class="block font-fs font-semibold text-sm uppercase optional">Signature Image</span>
                <div x-cloak x-show="!image" class="w-full">
                    <label for="dropzone-file"
                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 hover:bg-gray-100">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click
                                    to
                                    upload</span></p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or JPEG (MAX. 5MB)</p>
                        </div>
                        <input type="file" name="signature_image" @change="previewUpload($event)" id="dropzone-file"
                            class="hidden" />
                    </label>
                </div>

                <template x-if="image">
                    <div class="w-full flex flex-col items-center gap-y-4">
                        <img :src="image" alt="Image upload" class="w-1/2 aspect-square">

                        <button @click="clearUpload()" type="button"
                            class="btn btn-secondary btn-sm uppercase inline-flex items-center font-semibold">Clear</button>
                    </div>
                </template>

                <x-form.input-error :messages="$errors->get('signature_image')" class="mt-2" />
            </div>
            {{-- @dd(storage_path('')) --}}
            <div>
                <x-form.input-label for="name" :value="__('Name')" />

                <x-form.text-input id="name" class="block mt-1 w-full" type="text" name="name"
                    value="{{ old('name', $sig->name) }}" required autocomplete="current-password"
                    placeholder="Enter the name" />

                <x-form.input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-form.input-label for="position" :value="__('Position')" />

                <x-form.text-input id="position" class="block mt-1 w-full" type="text" name="position"
                    value="{{ old('position', $sig->position) }}" required autocomplete="current-password"
                    placeholder="Enter the position" />

                <x-form.input-error :messages="$errors->get('position')" class="mt-2" />
            </div>

            <div>
                <x-primary-button>Save</x-primary-button>
            </div>
        </form>
    </x-card>
</x-app.admin.main-container>
