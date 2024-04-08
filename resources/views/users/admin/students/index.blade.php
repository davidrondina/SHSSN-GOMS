<x-app.admin.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('Students')">
            <x-slot name="controls">
                <div class="flex items-center gap-x-4">
                    <x-form.search-form :form_action="__('#')" :placeholder="__('Search student name')" />

                    {{-- <form action="" method="get" class="flex gap-x-2">
                        <x-form.select.select-input>
                            @foreach ($departments as $dept)
                                <x-form.select.select-option :disabled="true" :selected="true" :option_name="__('Filter by dept.')" />
                                <x-form.select.select-option :value="$dept->id" :option_name="$dept->name" />
                            @endforeach
                        </x-form.select.select-input>

                        <x-primary-button>Go</x-primary-button>
                    </form> --}}

                    <a href="{{ route('admin.students.create') }}"
                        class="btn btn-primary btn-sm inline-flex items-center font-semibold">
                        <i class="fa-solid fa-plus"></i>Add Student
                    </a>
                </div>
            </x-slot>
        </x-app.page-header>

        <x-tablist.container class="my-3">
            <x-tablist.item href="{{ route('admin.students.index') }}"
                class="{{ Request::getRequestUri() === '/admin/students' ? 'tab-active font-semibold' : '' }}">All</x-tablist.item>
            <x-tablist.item href="{{ route('admin.students.index') . '?view=enrolled' }}"
                class="{{ Request::getRequestUri() === '/admin/students?view=enrolled' ? 'tab-active font-semibold' : '' }}">Enrolled
                {{ '(A.Y. ' . $year->getFullYear() . ')' }}</x-tablist.item>
            <x-tablist.item href="{{ route('admin.students.index') . '?view=notenrolled' }}"
                class="{{ Request::getRequestUri() === '/admin/students?view=notenrolled' ? 'tab-active font-semibold' : '' }}">Not
                Enrolled</x-tablist.item>
        </x-tablist.container>

        <x-table.wrapper>
            <x-table.head>
                <tr>
                    <x-table.header-cell :scope="__('col')">LRN</x-table.header-cell>
                    <x-table.header-cell :scope="__('col')">Student Name</x-table.header-cell>
                    <x-table.header-cell :scope="__('col')">Enrolled\Not enrolled</x-table.header-cell>
                    <x-table.header-cell :scope="__('col')">Actions</x-table.header-cell>
                </tr>
            </x-table.head>
            <x-table.body>
                {{-- <tr class="bg-white border-b">
                    <x-table.header-cell :scope="__('row')">#</x-table.header-cell>
                    <x-table.regular-cell>#</x-table.regular-cell>
                    <x-table.regular-cell>
                        <div class="flex gap-x-3">
                            <a href="#" class="btn btn-sm btn-accent"><i
                                    class="ri-eye-line font-normal"></i>View</a>
                            <a href="#" class="btn btn-sm btn-secondary inline-flex items-center font-semibold"><i
                                    class="ri-edit-box-line font-normal"></i>Edit</a>
                            <x-confirm-modal :type="__('warning')">
                                <button @click="open = !open" class="btn btn-sm btn-error"><i
                                        class="ri-delete-bin-line font-normal"></i>Delete
                                </button>

                                <x-slot name="header">
                                    Delete Student?
                                </x-slot>
                                <x-slot name="body">
                                    <p class="text-gray-500 text-sm">This action cannot be
                                        undone.</p>
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
                    </x-table.regular-cell>
                </tr> --}}
                @forelse ($students as $stu)
                    <tr class="bg-white border-b">
                        <x-table.header-cell :scope="__('row')">{{ $stu->lrn }}</x-table.header-cell>
                        <x-table.regular-cell>{{ $stu->getFullName() }}</x-table.regular-cell>
                        <x-table.regular-cell>Enrolled</x-table.regular-cell>
                        <x-table.regular-cell>
                            <div class="flex gap-x-3">
                                <a href="{{ route('admin.students.show', $stu->id) }}" class="btn btn-sm btn-accent"><i
                                        class="ri-eye-line font-normal"></i>View</a>
                                <a href="{{ route('admin.students.edit', $stu->id) }}"
                                    class="btn btn-sm btn-secondary inline-flex items-center font-semibold"><i
                                        class="ri-edit-box-line font-normal"></i>Edit</a>
                                <x-confirm-modal :type="__('warning')">
                                    <button @click="open = !open" class="btn btn-sm btn-error"><i
                                            class="ri-delete-bin-line font-normal"></i>Delete
                                    </button>

                                    <x-slot name="header">
                                        Delete Student?
                                    </x-slot>
                                    <x-slot name="body">
                                        <p class="text-gray-500 text-sm">This action cannot be
                                            undone.</p>
                                    </x-slot>

                                    <x-slot name="action">
                                        <form action="{{ route('admin.students.destroy', $stu->id) }}" method="post"
                                            class="flex">
                                            @csrf
                                            @method('DELETE')

                                            <button class="flex btn btn-warning font-poppins uppercase">Confirm</button>
                                        </form>
                                    </x-slot>
                                </x-confirm-modal>
                            </div>
                        </x-table.regular-cell>
                    </tr>
                @empty
                    <tr class="bg-white border-b">
                        <x-table.regular-cell colspan="4" class="text-center">No students
                            found.</x-table.regular-cell>
                    </tr>
                @endforelse
            </x-table.body>
        </x-table.wrapper>

        @unless (count($students) == 0)
            <div class="my-6">
                {{ $students->links() }}
            </div>
        @endunless
    </main>
</x-app.admin.main-container>
