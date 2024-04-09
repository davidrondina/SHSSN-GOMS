<x-app.admin.main-container>
    <x-app.page-header :show_back_btn="true" :back_btn_url="route('admin.sections.index')" />

    <x-card class="px-6 py-5 flex flex-col gap-y-5">
        <div class="card-title justify-between">
            <div class="flex flex-col gap-y-2">
                <h1 class="font-bold text-2xl">
                    {{ $section->name . ' (A.Y. ' . $section->academicYear->getFullYear() . ')' }}
                </h1>
                <p class="font-semibold text-sm">Adviser: <span
                        class="text-gray-500">{{ $section->adviser->user->profile->getFullName() }}</span></p>
            </div>
        </div>

        <div x-data="{ manageStudentsOpened: false }" class="mb-4 flex flex-col gap-y-2">
            <div class="flex justify-between">
                <h2 class="font-bold text-lg">Students</h2>
                <button @click="manageStudentsOpened = !manageStudentsOpened" class="btn btn-sm btn-primary">
                    <i class="font-normal fa-solid"
                        :class="manageStudentsOpened ? 'fa-solid fa-times' : 'ri-edit-box-line'"></i>
                    <span x-text="manageStudentsOpened ? 'Close' : 'Manage Students'"></span>
                </button>
            </div>

            <div x-cloak x-show="!manageStudentsOpened">
                <x-table.wrapper>
                    <x-table.head>
                        <tr>
                            <x-table.header-cell :scope="__('col')">Student Name</x-table.header-cell>
                            <x-table.header-cell :scope="__('col')">Actions</x-table.header-cell>
                        </tr>
                    </x-table.head>
                    <x-table.body>
                        @forelse ($section->students as $stu)
                            <tr class="bg-white border-b">
                                <x-table.header-cell
                                    :scope="__('row')">{{ $stu?->user?->profile->getFullName() ?? $stu->getFullName() }}</x-table.header-cell>
                                <x-table.regular-cell>
                                    <div class="flex gap-x-3">
                                        <a href="#" class="btn btn-sm btn-accent"><i
                                                class="ri-eye-line font-normal"></i>View</a>
                                        {{-- <x-confirm-modal :type="__('warning')">
                                            <button @click="open = !open" class="btn btn-sm btn-error"><i
                                                    class="ri-delete-bin-line font-normal"></i>Delete
                                            </button>

                                            <x-slot name="header">
                                                Delete Strand?
                                            </x-slot>
                                            <x-slot name="body">
                                                <p class="text-gray-500 text-sm">This action cannot be
                                                    undone.</p>
                                            </x-slot>

                                            <x-slot name="action">
                                                <form action="{{ route('admin.strands.destroy', $str->id) }}" method="post"
                                                    class="flex">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        class="flex btn btn-warning font-poppins uppercase">Confirm</button>
                                                </form>
                                            </x-slot>
                                        </x-confirm-modal> --}}
                                    </div>
                                </x-table.regular-cell>
                            </tr>
                        @empty
                            <tr class="bg-white border-b">
                                <x-table.regular-cell colspan="3" class="text-center">No students
                                    found.</x-table.regular-cell>
                            </tr>
                        @endforelse
                    </x-table.body>
                </x-table.wrapper>
            </div>

            <div x-cloak x-show="manageStudentsOpened">
                <form action="{{ route('admin.sections.students', $section->id) }}" method="post"
                    class="flex flex-col gap-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-form.select2 id="students" name="students[]">
                            @foreach ($students as $stu)
                                <option class="mb-2" value="{{ $stu->id }}"
                                    @if (in_array($stu->student->id, $section->students->pluck('id')->toArray())) selected @endif>
                                    {{ $stu->student->getFullName() }}</option>
                            @endforeach
                        </x-form.select2>

                        <x-form.input-error :messages="$errors->get('faculty')" class="mt-2" />
                    </div>

                    <div>
                        <x-primary-button>Save</x-primary-button>
                    </div>
                </form>
            </div>
        </div>

        <div x-data="{ manageSubjectsOpened: false }" class="mb-4 flex flex-col gap-y-2">
            <div class="flex justify-between">
                <h2 class="font-bold text-lg">Subjects</h2>
                <button @click="manageSubjectsOpened = !manageSubjectsOpened" class="btn btn-sm btn-primary">
                    <i class="font-normal fa-solid"
                        :class="manageSubjectsOpened ? 'fa-solid fa-times' : 'ri-edit-box-line'"></i>
                    <span x-text="manageSubjectsOpened ? 'Close' : 'Manage Subjects'"></span>
                </button>
            </div>

            <div x-cloak x-show="!manageSubjectsOpened">
                <x-table.wrapper>
                    <x-table.head>
                        <tr>
                            <x-table.header-cell :scope="__('col')">Subject Name</x-table.header-cell>
                            <x-table.header-cell :scope="__('col')">Faculty</x-table.header-cell>
                        </tr>
                    </x-table.head>
                    <x-table.body>
                        @forelse ($subjects as $sub)
                            <tr class="bg-white border-b">
                                <x-table.header-cell :scope="__('row')">{{ $sub->subject->name }}</x-table.header-cell>
                                <x-table.regular-cell>{{ $sub->faculty->user->profile->getFullName() }}</x-table.regular-cell>
                            </tr>
                        @empty
                            <tr class="bg-white border-b">
                                <x-table.regular-cell colspan="3" class="text-center">No students
                                    found.</x-table.regular-cell>
                            </tr>
                        @endforelse
                    </x-table.body>
                </x-table.wrapper>
            </div>

            <div x-cloak x-show="manageSubjectsOpened">

                <form action="{{ route('admin.sections.subjects', $section->id) }}" method="post"
                    class="flex flex-col gap-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-form.select2 id="subjects" name="subjects[]">
                            @foreach ($fac_with_subjects as $sub)
                                <option class="mb-2" value="{{ $sub->id }}"
                                    @if (in_array($sub->subject_id, $section->subjects->pluck('id')->toArray()) &&
                                            in_array($sub->faculty_id, $sec_subjects->pluck('faculty_id')->toArray())) selected @endif>
                                    {{ $sub->subject->name . ' (' . $sub->faculty->user->profile->getFullName() . ')' }}
                                </option>
                                {{-- <option value="{{ $sub->id }}">
                            {{ $sub->subject->name . ' (' . $sub->faculty->user->profile->getFullName() . ')' }}
                        </option> --}}
                            @endforeach
                        </x-form.select2>

                        <x-form.input-error :messages="$errors->get('faculty')" class="mt-2" />
                    </div>

                    <div>
                        <x-primary-button>Save</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </x-card>

    @push('js')
        <script>
            $(document).ready(function() {
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
