<x-app.admin.main-container>
    <x-app.page-header :show_back_btn="true" :back_btn_url="route('admin.subjects.index')" />

    <x-card class="px-6 py-5 flex flex-col gap-y-5">
        <div class="card-title">
            <h1 class="font-bold text-2xl">Section - Create</h1>
        </div>
        <form action="{{ route('admin.sections.store') }}" method="post" class="flex flex-col gap-y-4">
            @csrf

            <p><span class="font-semibold font-fs">Academic Year: </span>{{ $year->getFullYear() }}</p>

            <input type="hidden" name="year" value="{{ $year->id }}">

            <div>
                <x-form.input-label for="name" :value="__('Name')" />

                <x-form.text-input id="name" class="block mt-1 w-full" type="text" name="name"
                    value="{{ old('name') }}" required autocomplete="current-password"
                    placeholder="Enter the section name" />

                <x-form.input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <div class="block font-fs font-semibold text-sm uppercase">Adviser</div>

                <x-form.select2 id="adviser" name="adviser">
                    @forelse ($departments as $dept)
                        <optgroup label="{{ $dept->name }}">
                            @foreach ($dept->faculties as $fac)
                                <option value="{{ $fac->id }}">
                                    {{ $fac->user->profile->getFullName() }}
                                </option>
                            @endforeach
                        </optgroup>
                    @empty
                    @endforelse
                </x-form.select2>

                <x-form.input-error :messages="$errors->get('adviser')" class="mt-2" />
            </div>

            <div>
                <x-form.input-label for="strand" :value="__('Strand')" />

                <x-form.select.select-input id="strand" name="strand">
                    <x-form.select.select-option :disabled="true" :selected="true" :option_name="__('Select a strand.')" />

                    @foreach ($strands as $str)
                        <x-form.select.select-option :value="$str->id" :option_name="$str->abbr" />
                    @endforeach
                </x-form.select.select-input>

                <x-form.input-error :messages="$errors->get('strand')" class="mt-2" />
            </div>

            <div>
                <x-form.input-label for="grade_level" :value="__('Grade Level')" />

                <x-form.select.select-input id="grade_level" name="grade_level">
                    <x-form.select.select-option :disabled="true" :selected="true" :option_name="__('Set the grade level.')" />
                    <x-form.select.select-option :value="11" :option_name="__('Grade 11')" />
                    <x-form.select.select-option :value="12" :option_name="__('Grade 12')" />
                </x-form.select.select-input>

                <x-form.input-error :messages="$errors->get('grade_level')" class="mt-2" />
            </div>

            <div x-data="{ open: false }" class="flex flex-col gap-y-3">
                <div><button @click="open = !open" type="button" class="btn btn-sm btn-secondary">Add
                        student(s)?</button></div>

                <div x-cloak x-show="open">
                    <x-form.select2 id="students" name="students[]">
                        @forelse ($students as $stu)
                            <option value="{{ $stu->student->id }}">{{ $stu->student->user->profile->getFullName() }}
                            </option>
                        @empty
                        @endforelse
                    </x-form.select2>

                    <x-form.input-error :messages="$errors->get('faculty')" class="mt-2" />
                </div>
            </div>

            <div x-data="{ open: false }" class="flex flex-col gap-y-3">
                <div><button @click="open = !open" type="button" class="btn btn-sm btn-secondary">Add
                        subject(s)?</button></div>

                <div x-cloak x-show="open">
                    <x-form.select2 id="subjects" name="subjects[]">
                        @forelse ($fac_with_subjects as $sub)
                            <option value="{{ $sub->id }}">
                                {{ $sub->subject->name . ' (' . $sub->faculty->user->profile->getFullName() . ')' }}
                            </option>
                        @empty
                        @endforelse
                    </x-form.select2>

                    <x-form.input-error :messages="$errors->get('faculty')" class="mt-2" />
                </div>
            </div>

            <div>
                <x-primary-button>Create</x-primary-button>
            </div>
        </form>
    </x-card>

    @push('js')
        <script>
            $(document).ready(function() {
                $('#adviser').select2({
                    placeholder: 'Select an adviser',
                    maximumSelectionLength: 1,
                    width: 'resolve',
                });

                $('#students').select2({
                    placeholder: 'Select one or more students',
                    multiple: true,
                    width: 'resolve',
                });

                $('#subjects').select2({
                    placeholder: 'Select one or more subjects',
                    multiple: true,
                    width: 'resolve',
                });
            });
        </script>
    @endpush
</x-app.admin.main-container>
