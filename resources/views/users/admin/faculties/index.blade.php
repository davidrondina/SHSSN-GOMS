<x-app.admin.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('Faculties')">
            <x-slot name="controls">
                {{-- <a href="{{ route('admin.faculties.create') }}"
                    class="btn btn-primary btn-sm inline-flex items-center font-semibold">
                    <i class="fa-solid fa-plus"></i>Add Faculty
                </a> --}}
                <div class="flex items-center gap-x-4">
                    <x-form.search-form :form_action="__('#')" :placeholder="__('Search faculty')" />

                    <form action="" method="get" class="flex gap-x-2">
                        <x-form.select.select-input>
                            @foreach ($departments as $dept)
                                <x-form.select.select-option :disabled="true" :selected="true" :option_name="__('Filter by dept.')" />
                                <x-form.select.select-option :value="$dept->id" :option_name="$dept->name" />
                            @endforeach
                        </x-form.select.select-input>

                        <x-primary-button>Go</x-primary-button>
                    </form>
                </div>
            </x-slot>
        </x-app.page-header>

        <x-table.wrapper>
            <x-table.head>
                <tr>
                    <x-table.header-cell :scope="__('col')">Full Name</x-table.header-cell>
                    <x-table.header-cell :scope="__('col')">Department</x-table.header-cell>
                    <x-table.header-cell :scope="__('col')">Actions</x-table.header-cell>
                </tr>
            </x-table.head>
            <x-table.body>
                @forelse ($faculties as $fac)
                    <tr class="bg-white border-b">
                        <x-table.header-cell
                            :scope="__('row')">{{ $fac->user->profile->getFullName() }}</x-table.header-cell>
                        <x-table.regular-cell>{{ $fac->department->name }}</x-table.regular-cell>
                        <x-table.regular-cell>
                            <div class="flex gap-x-3">
                                <button class="btn btn-sm btn-accent"><i class="ri-eye-line font-normal"></i>View</button>
                                <a href="{{ route('admin.faculties.show', $fac->id) }}" class="btn btn-sm btn-accent"><i
                                        class="ri-eye-line font-normal"></i>View</a>
                                <a href="{{ route('admin.faculties.edit', $fac->id) }}"
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
                                        <p class="text-gray-500 text-sm">This action cannot be
                                            undone.</p>
                                    </x-slot>

                                    <x-slot name="action">
                                        <form action="{{ route('admin.faculties.destroy', $fac->id) }}" method="post"
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
                        <x-table.regular-cell colspan="3" class="text-center">No faculties
                            found.</x-table.regular-cell>
                    </tr>
                @endforelse
            </x-table.body>
        </x-table.wrapper>
    </main>
</x-app.admin.main-container>
