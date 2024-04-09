<x-app.admin.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('Unverified Users')">
            <x-slot name="controls">
                <div class="flex items-center gap-x-4">
                    <x-form.search-form :form_action="__('#')" :placeholder="__('Search user name')" />

                    {{-- <form action="" method="get" class="flex gap-x-2">
                        <x-form.select.select-input>
                            @foreach ($departments as $dept)
                                <x-form.select.select-option :disabled="true" :selected="true" :option_name="__('Filter by dept.')" />
                                <x-form.select.select-option :value="$dept->id" :option_name="$dept->name" />
                            @endforeach
                        </x-form.select.select-input>

                        <x-primary-button>Go</x-primary-button>
                    </form> --}}
                </div>
            </x-slot>
        </x-app.page-header>

        <x-table.wrapper>
            <x-table.head>
                <tr>
                    <x-table.header-cell :scope="__('col')">LRN</x-table.header-cell>
                    <x-table.header-cell :scope="__('col')">Name</x-table.header-cell>
                    <x-table.header-cell :scope="__('col')">Address</x-table.header-cell>
                    <x-table.header-cell :scope="__('col')">Actions</x-table.header-cell>
                </tr>
            </x-table.head>
            <x-table.body>
                @forelse ($users as $user)
                    <tr class="bg-white border-b">
                        <x-table.header-cell :scope="__('row')">{{ $user->lrn }}</x-table.header-cell>
                        <x-table.regular-cell>{{ $user->getFullName() }}</x-table.regular-cell>
                        <x-table.regular-cell>{{ $user->address }}</x-table.regular-cell>
                        <x-table.regular-cell>
                            <div class="flex gap-x-3">
                                <a href="{{ route('admin.unverified-users.show', $user->id) }}"
                                    class="btn btn-sm btn-accent"><i class="ri-eye-line font-normal"></i>View</a>
                                <form action="{{ route('admin.unverified-users.approve', $user->id) }}" method="post">
                                    @csrf

                                    <button class="btn btn-sm btn-success"><i
                                            class="ri-checkbox-circle-line font-normal"></i>Approve</button>
                                </form>
                                <form action="{{ route('admin.unverified-users.reject', $user->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-error"><i
                                            class="ri-close-circle-line font-normal"></i>Reject</button>
                                </form>

                                <x-confirm-modal :type="__('warning')">
                                    <button @click="open = !open" class="btn btn-sm btn-error"><i
                                            class="ri-delete-bin-line font-normal"></i>Delete
                                    </button>

                                    <x-slot name="header">
                                        Delete Unverified User?
                                    </x-slot>
                                    <x-slot name="body">
                                        <p class="text-gray-500 text-sm">This action cannot be
                                            undone.</p>
                                    </x-slot>

                                    <x-slot name="action">
                                        <form action="{{ route('admin.unverified-users.destroy', $user->id) }}"
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
                        <x-table.regular-cell colspan="4" class="text-center">No submissions
                            found.</x-table.regular-cell>
                    </tr>
                @endforelse
            </x-table.body>
        </x-table.wrapper>
    </main>
</x-app.admin.main-container>