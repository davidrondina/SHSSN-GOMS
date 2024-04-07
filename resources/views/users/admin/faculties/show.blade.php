<x-app.admin.main-container>
    <x-app.page-header :show_back_btn="true" :back_btn_url="route('admin.faculties.index')" />

    <x-card class="px-6 py-5 flex flex-col gap-y-5">
        <div class="card-title justify-between">
            <div class="flex flex-col gap-y-2">
                <h1 class="font-bold text-2xl">
                    {{ $faculty->user->profile->getFullName() }}
                </h1>
                <p class="font-semibold text-sm">Department: <span
                        class="text-gray-500">{{ $faculty->department->name }}</span></p>
            </div>

            <div class="flex gap-x-3">
                <a href="{{ route('admin.faculties.edit', $faculty->id) }}"
                    class="btn btn-sm btn-secondary inline-flex items-center font-semibold"><i
                        class="ri-edit-box-line font-normal"></i>Edit</a>
                <x-confirm-modal :type="__('warning')">
                    <button @click="open = !open" class="btn btn-sm btn-error"><i
                            class="ri-delete-bin-line font-normal"></i>Delete
                    </button>

                    <x-slot name="header">
                        Delete Faculty?
                    </x-slot>
                    <x-slot name="body">
                        <p class="text-gray-500 text-sm">This will delete their subjects, complaints, and advisory
                            sections.</p>
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
        </div>

        <div class="mb-4 flex flex-col gap-y-2">
            <h2 class="font-bold text-lg">Personal Information</h2>

            <div class="grid grid-cols-2 gap-3 text-sm">
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Sex</p>
                    <p>{{ $faculty->user->profile->sex }}</p>
                </div>
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Birthdate</p>
                    <p>{{ $faculty->user->profile->birthdate }}</p>
                </div>
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Phone Number</p>
                    <p>{{ $faculty->user->profile->phone_no }}</p>
                </div>
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Email Address</p>
                    <p>{{ $faculty->user->email }}</p>
                </div>
            </div>
        </div>

        <div x-data="{ manageSubjectsOpened: false }" class="mb-4 flex flex-col gap-y-2">
            <div class="flex justify-between">
                <h2 class="font-bold text-lg">Subjects <span class="text-sm text-gray-500 font-normal">(Click "Manage
                        Subjects" to add/remove subjects)</span></h2>
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
                        </tr>
                    </x-table.head>
                    <x-table.body>
                        @forelse ($faculty->subjects as $sub)
                            <tr class="bg-white border-b">
                                <x-table.header-cell :scope="__('row')">{{ $sub->name }}</x-table.header-cell>
                            </tr>
                        @empty
                            <tr class="bg-white border-b">
                                <x-table.regular-cell colspan="3" class="text-center">No subjects
                                    found.</x-table.regular-cell>
                            </tr>
                        @endforelse
                    </x-table.body>
                </x-table.wrapper>
            </div>

            <div x-cloak x-show="manageSubjectsOpened">
                <form action="{{ route('admin.faculties.subjects', $faculty->id) }}" method="post"
                    class="flex flex-col gap-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-form.select2 id="subjects" name="subjects[]" required>
                            @foreach ($subjects as $sub)
                                <option class="mb-2" value="{{ $sub->id }}"
                                    @if (in_array($sub->id, $faculty->subjects->pluck('id')->toArray())) selected @endif>
                                    {{ $sub->name }}</option>
                            @endforeach
                        </x-form.select2>

                        <x-form.input-error :messages="$errors->get('subjects')" class="mt-2" />
                    </div>

                    <div>
                        <x-primary-button>Save</x-primary-button>
                    </div>
                </form>
            </div>
        </div>

        <div class="flex flex-col gap-y-2">
            <div class="flex justify-between">
                <h2 class="font-bold text-lg">Advisories</h2>
            </div>

            <x-table.wrapper>
                <x-table.head>
                    <tr>
                        <x-table.header-cell :scope="__('col')">Section Name</x-table.header-cell>
                        <x-table.header-cell :scope="__('col')">Academic Year</x-table.header-cell>
                        <x-table.header-cell :scope="__('col')">Actions</x-table.header-cell>
                    </tr>
                </x-table.head>
                <x-table.body>
                    @forelse ($faculty->advisorySections as $sec)
                        <tr class="bg-white border-b">
                            <x-table.header-cell :scope="__('row')">{{ $sec->name }}</x-table.header-cell>
                            <x-table.regular-cell>{{ $sec->academicYear->getFullYear() }}</x-table.regular-cell>
                            <x-table.regular-cell class="regular-cell">
                                <div class="flex gap-x-3"><a href="{{ route('admin.sections.show', $sec->id) }}"
                                        class="btn btn-sm btn-accent"><i class="ri-eye-line font-normal"></i>View</a>
                                </div>
                            </x-table.regular-cell>
                        </tr>
                    @empty
                        <tr class="bg-white border-b">
                            <x-table.regular-cell colspan="3" class="text-center">No sections
                                found.</x-table.regular-cell>
                        </tr>
                    @endforelse
                </x-table.body>
            </x-table.wrapper>
        </div>
    </x-card>

    @push('js')
        <script>
            $(document).ready(function() {
                $('#subjects').select2({
                    placeholder: 'Select one or more subjects',
                    multiple: true,
                    width: 'resolve',
                });
            });
        </script>
    @endpush
</x-app.admin.main-container>
