<x-app.admin.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('Subjects')">
            <x-slot name="controls">
                <div class="flex items-center gap-x-4">
                    <x-form.search-form :form_action="route('admin.subjects.index')" :placeholder="__('Search subject name')" />

                    {{-- <form action="" method="get" class="flex gap-x-2">
                        <x-form.select.select-input>
                            @foreach ($departments as $dept)
                                <x-form.select.select-option :disabled="true" :selected="true" :option_name="__('Filter by dept.')" />
                                <x-form.select.select-option :value="$dept->id" :option_name="$dept->name" />
                            @endforeach
                        </x-form.select.select-input>

                        <x-primary-button>Go</x-primary-button>
                    </form> --}}

                    <a href="{{ route('admin.subjects.create') }}"
                        class="btn btn-primary btn-sm inline-flex items-center font-semibold">
                        <i class="fa-solid fa-plus"></i>Add Subject
                    </a>
                </div>
            </x-slot>
        </x-app.page-header>

        <x-table.wrapper>
            <x-table.head>
                <tr>
                    <x-table.header-cell :scope="__('col')">Subject Name</x-table.header-cell>
                    <x-table.header-cell :scope="__('col')">Actions</x-table.header-cell>
                </tr>
            </x-table.head>
            <x-table.body>
                {{-- <tr class="bg-white border-b">
                    <x-table.header-cell :scope="__('row')">Filipino</x-table.header-cell>
                    <x-table.regular-cell>
                        <div class="flex gap-x-3">
                            <button type="button" class="btn btn-sm btn-accent">Assign Faculty</button>
                            <a href="#"
                                class="btn btn-sm btn-secondary inline-flex items-center font-semibold">Edit</a>
                            <a href="#"
                                class="btn btn-sm btn-error inline-flex items-center font-semibold">Delete</a>
                        </div>
                    </x-table.regular-cell>
                </tr> --}}
                @forelse ($subjects as $sub)
                    <tr class="bg-white border-b">
                        <x-table.header-cell :scope="__('row')">{{ $sub->name }}</x-table.header-cell>
                        <x-table.regular-cell>
                            <div class="flex gap-x-3">
                                <a href="{{ route('admin.subjects.edit', $sub->id) }}"
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
                                        <form action="{{ route('admin.subjects.destroy', $sub->id) }}" method="post"
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
                        <x-table.regular-cell colspan="2" class="text-center">No subjects
                            found.</x-table.regular-cell>
                    </tr>
                @endforelse
            </x-table.body>
        </x-table.wrapper>
    </main>
</x-app.admin.main-container>
