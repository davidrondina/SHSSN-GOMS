<x-app.faculty.main-container>
    <x-app.page-header :show_back_btn="true" :back_btn_url="route('faculty.classes.index')" />

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

        <div class="mb-4 flex flex-col gap-y-2">
            <div class="flex justify-between">
                <h2 class="font-bold text-lg">Students</h2>
            </div>

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
                                    <a href="{{ route('faculty.students.show', $stu->id) }}"
                                        class="btn btn-sm btn-accent"><i class="ri-eye-line font-normal"></i>View</a>
                                </div>
                            </x-table.regular-cell>
                        </tr>
                    @empty
                        <tr class="bg-white border-b">
                            <x-table.regular-cell colspan="2" class="text-center">No students
                                found.</x-table.regular-cell>
                        </tr>
                    @endforelse
                </x-table.body>
            </x-table.wrapper>
        </div>

        <div class="mb-4 flex flex-col gap-y-2">
            <div class="flex justify-between">
                <h2 class="font-bold text-lg">Subjects</h2>
            </div>

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
    </x-card>
</x-app.faculty.main-container>
