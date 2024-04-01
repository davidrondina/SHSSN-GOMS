<x-app.admin.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('Faculty Departments')">
            <x-slot name="controls">
                <a href="{{ route('admin.departments.create') }}"
                    class="btn btn-primary btn-sm inline-flex items-center font-semibold">
                    <i class="fa-solid fa-plus"></i>Add Dept
                </a>
            </x-slot>
        </x-app.page-header>

        <x-table.wrapper>
            <x-table.head>
                <tr>
                    <x-table.header-cell :scope="__('col')">Dept. Name</x-table.header-cell>
                    <x-table.header-cell :scope="__('col')">Actions</x-table.header-cell>
                </tr>
            </x-table.head>
            <x-table.body>
                @forelse ($departments as $dept)
                    <tr class="bg-white border-b">
                        <x-table.header-cell :scope="__('row')">{{ $dept->name }}</x-table.header-cell>
                        <x-table.regular-cell>
                            <div class="flex gap-x-3">
                                <a href="{{ route('admin.departments.edit', $dept->id) }}"
                                    class="btn btn-sm btn-secondary inline-flex items-center font-semibold">Edit</a>
                                <a href="{{ route('admin.departments.destroy', $dept->id) }}"
                                    class="btn btn-sm btn-error inline-flex items-center font-semibold">Delete</a>
                            </div>
                        </x-table.regular-cell>
                    </tr>
                @empty
                    <tr class="bg-white border-b">
                        <x-table.regular-cell colspan="2" class="text-center">No departments
                            found.</x-table.regular-cell>
                    </tr>
                @endforelse
            </x-table.body>
        </x-table.wrapper>
    </main>
</x-app.admin.main-container>
