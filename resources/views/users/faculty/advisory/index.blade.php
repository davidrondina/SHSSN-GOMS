<x-app.faculty.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('Advisory')">
            {{-- <x-slot name="controls">
                <div x-data="{ filterOpened: false }" class="flex gap-x-4">
                    <a href="{{ route('admin.sections.create') }}"
                        class="btn btn-primary btn-sm inline-flex items-center font-semibold">
                        <i class="fa-solid fa-plus"></i>Add Section
                    </a>

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
            </x-slot> --}}
        </x-app.page-header>

        <x-card class="mb-4 px-4 py-8 flex flex-col gap-y-8">
            <div class="flex flex-col gap-y-4">
                <div class="flex flex-col gap-y-2">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-bold">A.Y. {{ $year->getFullYear() }}</h3>
                        @if ($current_advisory)
                            <a href="{{ route('faculty.advisory.current') }}" class="btn-link">See More</a>
                        @endif
                    </div>

                    <h4 class="font-bold font-fs text-gray-500">{{ $current_advisory->name }}</h4>
                </div>

                <div class="font-fs grid grid-cols-1 md:grid-cols-2">
                    <x-card class="py-3 px-4 flex flex-row gap-x-4">
                        <div>
                            <div
                                class="w-12 aspect-square border border-accent rounded-full inline-flex justify-center items-center text-xl text-accent">
                                <i class="fa-solid fa-user-graduate"></i>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <h2 class="font-semibold uppercase text-sm text-gray-500">Students</h2>

                            <div>
                                <span
                                    class="text-2xl truncate font-semibold">{{ $current_advisory->students->count() }}</span>
                            </div>
                        </div>
                    </x-card>

                    <x-card class="py-3 px-4 flex flex-row gap-x-4">
                        <div>
                            <div
                                class="w-12 aspect-square border border-red-700 rounded-full inline-flex justify-center items-center text-xl text-red-700">
                                <i class="fa-solid fa-book-open"></i>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <h2 class="font-semibold uppercase text-sm text-gray-500">Subjects</h2>

                            <div>
                                <span
                                    class="text-2xl truncate font-semibold">{{ $current_advisory->subjects->count() }}</span>
                            </div>
                        </div>
                    </x-card>
                </div>
            </div>
        </x-card>

        <div class="flex flex-col gap-y-2">
            <h2 class="font-bold text-lg">Previous Advisories</h2>
            <x-table.wrapper>
                <x-table.head>
                    <tr>
                        <x-table.header-cell :scope="__('col')">Section Name</x-table.header-cell>
                        <x-table.header-cell :scope="__('col')">Strand</x-table.header-cell>
                        <x-table.header-cell :scope="__('col')">Grade Level</x-table.header-cell>
                        <x-table.header-cell :scope="__('col')">Actions</x-table.header-cell>
                    </tr>
                </x-table.head>
                <x-table.body>
                    @forelse ($prev_advisories as $sec)
                        <tr class="bg-white border-b">
                            <x-table.header-cell :scope="__('row')">{{ $sec->name }}</x-table.header-cell>
                            <x-table.regular-cell>{{ $sec->strand->name }} </x-table.regular-cell>
                            <x-table.regular-cell>{{ $sec->grade_level }} </x-table.regular-cell>
                            <x-table.regular-cell>
                                <div class="flex gap-x-3">
                                    <a href="{{ route('faculty.advisory.show', $sec->id) }}"
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
    </main>
</x-app.faculty.main-container>
