<x-app.admin.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('Academic Strands')">
            <x-slot name="controls">
                <a href="{{ route('admin.strands.create') }}"
                    class="btn btn-primary btn-sm inline-flex items-center font-semibold">
                    <i class="fa-solid fa-plus"></i>Add Strand
                </a>
            </x-slot>
        </x-app.page-header>

        <x-table.wrapper>
            <x-table.head>
                <tr>
                    <x-table.header-cell :scope="__('col')">Abbreviation</x-table.header-cell>
                    <x-table.header-cell :scope="__('col')">Name of Strand</x-table.header-cell>
                    <x-table.header-cell :scope="__('col')">Actions</x-table.header-cell>
                </tr>
            </x-table.head>
            <x-table.body>
                @forelse ($strands as $str)
                    <tr class="bg-white border-b">
                        <x-table.header-cell :scope="__('row')">{{ $str->abbr }}</x-table.header-cell>
                        <x-table.regular-cell>{{ $str->name }}</x-table.regular-cell>
                        <x-table.regular-cell>
                            <div class="flex gap-x-3">
                                <a href="{{ route('admin.strands.edit', $str->id) }}"
                                    class="btn btn-sm btn-secondary inline-flex items-center font-semibold">Edit</a>
                                <a href="{{ route('admin.strands.destroy', $str->id) }}"
                                    class="btn btn-sm btn-error inline-flex items-center font-semibold">Delete</a>
                            </div>
                        </x-table.regular-cell>
                    </tr>
                @empty
                    <tr class="bg-white border-b">
                        <x-table.regular-cell colspan="3" class="text-center">No strands
                            found.</x-table.regular-cell>
                    </tr>
                @endforelse
            </x-table.body>
        </x-table.wrapper>
    </main>
</x-app.admin.main-container>
