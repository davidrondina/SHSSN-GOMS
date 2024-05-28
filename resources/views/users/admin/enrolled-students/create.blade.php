<x-app.admin.main-container>
    <x-app.page-header :show_back_btn="true" :back_btn_url="url()->previous()" />

    <x-card class="px-6 py-5 flex flex-col gap-y-5">
        <div class="card-title">
            <h1 class="font-bold text-2xl">Enroll Students</h1>
        </div>
        <form action="{{ route('admin.enrolled-students.store') }}" method="post" class="flex flex-col gap-y-4">
            @csrf

            <input type="hidden" name="year_id" value="{{ $year->id }}">
            <div>
                <span class="block font-fs font-semibold text-sm uppercase">Select one or more students</span>
                <x-form.select2 id="students" name="students[]" class="mt-1">
                    @forelse ($students as $stu)
                        <option value="{{ $stu->id }}">
                            {{ $stu->getFullName() . ' - ' . $stu->lrn }}
                        </option>
                    @empty
                    @endforelse
                </x-form.select2>

                <x-form.input-error :messages="$errors->get('students')" class="mt-2" />
            </div>

            <div>
                <x-form.input-label for="grade_level" :value="__('Grade Level')" />
                <x-form.select.select-input name="grade_level" id="grade_level" class="block mt-1 w-full">
                    <x-form.select.select-option :disabled="true" :selected="true" :option_name="__('Select grade level')" required s />

                    <x-form.select.select-option :value="11" :option_name="__('Gr. 11')" />
                    <x-form.select.select-option :value="12" :option_name="__('Gr. 12')" />
                </x-form.select.select-input>

                <x-form.input-error :messages="$errors->get('grade_level')" class="mt-2" />
            </div>

            <div>
                <x-form.input-label for="strand" :value="__('Strand')" />
                <x-form.select.select-input name="strand" id="strand" class="block mt-1 w-full">
                    <x-form.select.select-option :disabled="true" :selected="true" :option_name="__('Select a strand')" />

                    @foreach ($strands as $str)
                        <x-form.select.select-option :value="$str->id" :option_name="$str->abbr" />
                    @endforeach
                </x-form.select.select-input>
            </div>

            <div>
                <x-confirm-modal :type="__('success')">
                    <button type="button" @click="open = !open" class="btn btn-primary uppercase">Done</button>

                    <x-slot name="header">
                        Enroll students?
                    </x-slot>
                    <x-slot name="body">
                        <p class="text-gray-500 text-sm">Please make sure you have selected all desired students before
                            proceeding to this action.</p>
                    </x-slot>

                    <x-slot name="action">
                        <form action="{{ route('admin.enrolled-students.store') }}" method="post" class="flex">
                            @csrf

                            <button class="flex btn btn-success font-poppins uppercase">Enroll</button>
                        </form>
                    </x-slot>
                </x-confirm-modal>
            </div>
        </form>
    </x-card>

    @push('js')
        <script>
            $(document).ready(function() {
                $('#students').select2({
                    placeholder: 'Select one or more students',
                    multiple: true,
                    width: 'resolve',
                });
            });
        </script>
    @endpush
</x-app.admin.main-container>
