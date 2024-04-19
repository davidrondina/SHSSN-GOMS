<x-app.admin.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('A.Y. ' . $year->getFullYear())" :show_back_btn="true" :back_btn_url="route('admin.academic-years.index')">
            <x-slot name="controls">
                <div x-data="{ filterOpened: false }" class="flex gap-x-4">
                    <button x-ref="filterBtn" @click="filterOpened = !filterOpened" type="button"
                        class="btn btn-sm btn-accent">
                        <i class="fa-solid" :class="filterOpened ? 'fa-times' : 'fa-filter'"></i>
                        <span x-text="filterOpened ? 'Close' : 'Filter'"></span>
                    </button>

                    <div x-cloak @click.outside="filterOpened = false" x-show="filterOpened"
                        x-anchor.bottom-end="$refs.filterBtn"
                        class="z-20 bg-white p-4 w-[600px] flex flex-col gap-y-4 border border-gray-300 shadow-md">
                        <x-form.search-form :form_action="__('#')" :placeholder="__('Search section name')" class="w-full" />

                        <form action="" method="get" class="flex gap-x-2">
                            <x-form.select.select-input>
                                @foreach ($strands as $str)
                                    <x-form.select.select-option :disabled="true" :selected="true"
                                        :option_name="__('Filter by strand')" />
                                    <x-form.select.select-option :value="$str->id" :option_name="$str->abbr" />
                                @endforeach
                            </x-form.select.select-input>

                            <x-form.select.select-input>
                                <x-form.select.select-option :disabled="true" :selected="true" :option_name="__('Filter by grade level')" />
                                <x-form.select.select-option :value="11" :option_name="__('Gr. 11')" />
                                <x-form.select.select-option :value="12" :option_name="__('Gr. 12')" />
                            </x-form.select.select-input>

                            <x-primary-button>Go</x-primary-button>
                        </form>
                    </div>
                </div>
            </x-slot>
        </x-app.page-header>

        <x-table.wrapper>
            <x-table.head>
                <tr>
                    <x-table.header-cell :scope="__('col')">Section Name</x-table.header-cell>
                    <x-table.header-cell :scope="__('col')">Adviser</x-table.header-cell>
                    <x-table.header-cell :scope="__('col')">Strand</x-table.header-cell>
                    <x-table.header-cell :scope="__('col')">Grade Level</x-table.header-cell>
                    <x-table.header-cell :scope="__('col')">Actions</x-table.header-cell>
                </tr>
            </x-table.head>
            <x-table.body>
                @forelse ($sections as $sec)
                    <tr class="bg-white border-b">
                        <x-table.header-cell :scope="__('row')">{{ $sec->name }}</x-table.header-cell>
                        <x-table.regular-cell>{{ $sec->adviser->user->profile->getFullName() }} </x-table.regular-cell>
                        <x-table.regular-cell>{{ $sec->strand->name }} </x-table.regular-cell>
                        <x-table.regular-cell>{{ $sec->grade_level }} </x-table.regular-cell>
                        <x-table.regular-cell>
                            <div class="flex gap-x-3">
                                <a href="{{ route('admin.sections.show', $sec->id) }}" class="btn btn-sm btn-accent"><i
                                        class="ri-eye-line font-normal"></i>View</a>
                                <a href="{{ route('admin.sections.edit', $sec->id) }}"
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
                                        <form action="#" method="post" class="flex">
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
                        <x-table.regular-cell colspan="5" class="text-center">No sections
                            found.</x-table.regular-cell>
                    </tr>
                @endforelse
            </x-table.body>
        </x-table.wrapper>

        @unless (count($sections) == 0)
            <div class="my-6">
                {{ $sections->links() }}
            </div>
        @endunless
    </main>
</x-app.admin.main-container>
