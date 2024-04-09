<x-app.admin.main-container>
    <x-app.page-header :show_back_btn="true" :back_btn_url="route('admin.students.index')" />

    <x-card class="px-6 py-5 flex flex-col gap-y-5">
        <div class="card-title justify-between">
            <div class="flex flex-col gap-y-2">
                <h1 class="font-bold text-2xl">
                    {{ $student->getFullName() }}
                </h1>
                <p class="font-semibold text-sm">LRN: <span class="text-gray-500">{{ $student->lrn }}</span></p>
            </div>

            <div class="flex gap-x-3">
                <a href="{{ route('admin.students.edit', $student->id) }}"
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
                @if ($student?->user?->profile)
                    <div class="flex flex-col gap-y-2">
                        <p class="font-semibold">Sex</p>
                        <p>{{ $student->user->profile->sex }}</p>
                    </div>
                @endif
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Birthdate</p>
                    <p>{{ $student->birthdate }}</p>
                </div>
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Phone Number</p>
                    <p>{{ $student->phone_no }}</p>
                </div>
                @if ($student->user)
                    <div class="flex flex-col gap-y-2">
                        <p class="font-semibold">Email Address</p>
                        <p>{{ $student->user->email }}</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="mb-4 flex flex-col gap-y-2">
            <h2 class="font-bold text-lg">Guardian Information</h2>

            <div class="grid grid-cols-2 gap-3 text-sm">
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Name</p>
                    <p>{{ $student->guardian->getFullName() }}</p>
                </div>
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Phone Number</p>
                    <p>{{ $student->guardian->phone_no }}</p>
                </div>
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Email Address</p>
                    <p>{{ $student->guardian->email ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-y-2">
            <div class="flex justify-between">
                <h2 class="font-bold text-lg">Sections</h2>
            </div>

            <x-table.wrapper>
                <x-table.head>
                    <tr>
                        <x-table.header-cell :scope="__('col')">Section Name</x-table.header-cell>
                        <x-table.header-cell :scope="__('col')">Adviser</x-table.header-cell>
                        <x-table.header-cell :scope="__('col')">Academic Year</x-table.header-cell>
                        <x-table.header-cell :scope="__('col')">Actions</x-table.header-cell>
                    </tr>
                </x-table.head>
                <x-table.body>
                    @forelse ($student->sections as $sec)
                        <tr class="bg-white border-b">
                            <x-table.header-cell :scope="__('row')">{{ $sec->name }}</x-table.header-cell>
                            <x-table.regular-cell>{{ $sec->adviser->user->profile->getFullName() }}</x-table.regular-cell>
                            <x-table.regular-cell>{{ $sec->academicYear->getFullYear() }}</x-table.regular-cell>
                            <x-table.regular-cell class="regular-cell">
                                <div class="flex gap-x-3"><a href="{{ route('admin.sections.show', $sec->id) }}"
                                        class="btn btn-sm btn-accent"><i class="ri-eye-line font-normal"></i>View</a>
                                </div>
                            </x-table.regular-cell>
                        </tr>
                    @empty
                        <tr class="bg-white border-b">
                            <x-table.regular-cell colspan="4" class="text-center">No sections
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
