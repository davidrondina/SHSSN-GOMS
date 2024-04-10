<x-app.admin.main-container>
    <x-app.page-header :show_back_btn="true" :back_btn_url="route('admin.academic-years.index')" />

    <x-card class="px-6 py-5 flex flex-col gap-y-5">
        <div class="card-title">
            <h1 class="font-bold text-2xl">Academic Year - Create</h1>
        </div>
        <form action="{{ route('admin.academic-years.store') }}" method="post" class="flex flex-col gap-y-4">
            @csrf

            <p class="text-sm">All the students registered will be unenrolled and sections
                have to be created in this new academic year.</p>

            <div class="flex gap-x-2">
                <div class="flex-1">
                    <x-form.input-label for="start_date" :value="__('Start Date')" />

                    <x-form.date-input id="start_date" name="start_date" value="{{ old('start_date ') }}"
                        class="block mt-1 w-full" required />

                    <x-form.input-error :messages="$errors->get('start_date')" class="mt-2" />
                </div>

                <div class="flex-1">
                    <x-form.input-label for="end_date" :value="__('End Date')" />

                    <x-form.date-input id="end_date" name="end_date" value="{{ old('end_date ') }}"
                        class="block mt-1 w-full" required />

                    <x-form.input-error :messages="$errors->get('end_date')" class="mt-2" />
                </div>
            </div>

            <div>
                <x-confirm-modal :type="__('warning')">
                    <x-primary-button @click="open = !open" type="button">Create</x-primary-button>

                    <x-slot name="header">
                        WARNING: This academic year will be set as the current one!
                    </x-slot>

                    <x-slot name="body">
                        <p class="text-gray-500 text-sm">All the students registered will be unenrolled and sections
                            have to be created in this new academic year.</p>
                    </x-slot>

                    <x-slot name="action">
                        <x-primary-button class="btn-warning font-is">Confirm</x-primary-button>
                    </x-slot>
                </x-confirm-modal>
            </div>
        </form>
    </x-card>
</x-app.admin.main-container>
