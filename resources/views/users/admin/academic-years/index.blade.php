<x-app.admin.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('Academic Year Archive')">
            <x-slot name="controls">
                <div class="flex items-center gap-x-4">
                    <x-form.search-form :form_action="__('#')" :placeholder="__('Search a record')" />

                    <a href="{{ route('admin.academic-years.create') }}"
                        class="btn btn-primary btn-sm inline-flex items-center font-semibold">
                        <i class="fa-solid fa-plus"></i>New Academic Year
                    </a>
                </div>
            </x-slot>
        </x-app.page-header>

        <x-table.wrapper>
            <x-table.head>
                <tr>
                    <x-table.header-cell :scope="__('col')">Academic Year</x-table.header-cell>
                    <x-table.header-cell :scope="__('col')">Actions</x-table.header-cell>
                </tr>
            </x-table.head>
            <x-table.body>
                @forelse ($academic_years as $year)
                    <tr class="bg-white border-b">
                        <x-table.header-cell :scope="__('row')">{{ $year->getFullYear() }}</x-table.header-cell>
                        <x-table.regular-cell>
                            <div class="flex gap-x-3">
                                <a href="{{ route('admin.academic-years.show', $year->id) }}"
                                    class="btn btn-sm btn-accent"><i class="ri-eye-line font-normal"></i>View</a>
                                <a href="{{ route('admin.academic-years.edit', $year->id) }}"
                                    class="btn btn-sm btn-secondary inline-flex items-center font-semibold"><i
                                        class="ri-edit-box-line font-normal"></i>Edit</a>
                                <x-confirm-modal :type="__('warning')">
                                    <button @click="open = !open" class="btn btn-sm btn-error"><i
                                            class="ri-delete-bin-line font-normal"></i>Delete
                                    </button>

                                    <x-slot name="header">
                                        Delete Subject?
                                    </x-slot>
                                    <x-slot name="body">
                                        <p class="text-gray-500 text-sm">This action cannot be
                                            undone.</p>
                                    </x-slot>

                                    <x-slot name="action">
                                        <form action="{{ route('admin.academic-years.destroy', $year->id) }}"
                                            method="post" class="flex">
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
                        <x-table.regular-cell colspan="2" class="text-center">No records
                            found.</x-table.regular-cell>
                    </tr>
                @endforelse
            </x-table.body>
        </x-table.wrapper>
    </main>
</x-app.admin.main-container>
