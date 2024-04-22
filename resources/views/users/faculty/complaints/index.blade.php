<x-app.faculty.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('My Complaints')">
            <x-slot name="controls">
                <a href="{{ route('faculty.complaints.create') }}"
                    class="btn btn-primary btn-sm inline-flex items-center font-semibold">
                    <i class="fa-solid fa-plus"></i>Submit a complaint
                </a>
            </x-slot>
        </x-app.page-header>

        <x-table.wrapper>
            <x-table.head>
                <tr>
                    <x-table.header-cell :scope="__('col')">Respondent</x-table.header-cell>
                    <x-table.header-cell :scope="__('col')">Reason</x-table.header-cell>
                    <x-table.header-cell :scope="__('col')">Date Submitted</x-table.header-cell>
                    <x-table.header-cell :scope="__('col')">Actions</x-table.header-cell>
                </tr>
            </x-table.head>
            <x-table.body>
                @forelse ($complaints as $com)
                    <tr class="bg-white border-b">
                        <x-table.header-cell
                            :scope="__('row')">{{ $com->respondent->getFullName() }}</x-table.header-cell>
                        <x-table.regular-cell>{{ $com->reason }}</x-table.regular-cell>
                        <x-table.regular-cell>{{ \Carbon\Carbon::parse($com->created_at)->format('M. d, Y') }}</x-table.regular-cell>
                        <x-table.regular-cell>
                            <div class="flex gap-x-3">
                                <a href="{{ route('faculty.complaints.edit', $com->id) }}"
                                    class="btn btn-sm btn-secondary inline-flex items-center font-semibold"><i
                                        class="ri-edit-box-line font-normal"></i>Edit</a>
                                <x-confirm-modal :type="__('warning')">
                                    <button @click="open = !open" class="btn btn-sm btn-error"><i
                                            class="ri-delete-bin-line font-normal"></i>Delete
                                    </button>

                                    <x-slot name="header">
                                        Delete Complaint?
                                    </x-slot>
                                    <x-slot name="body">
                                        <p class="text-gray-500 text-sm">This action cannot be
                                            undone.</p>
                                    </x-slot>

                                    <x-slot name="action">
                                        <form action="{{ route('faculty.complaints.destroy', $com->id) }}"
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
                        <x-table.regular-cell colspan="4" class="text-center">No complaints
                            found.</x-table.regular-cell>
                    </tr>
                @endforelse
            </x-table.body>
        </x-table.wrapper>

        @unless (count($complaints) == 0)
            <div class="my-6">
                {{ $complaints->links() }}
            </div>
        @endunless
    </main>
</x-app.faculty.main-container>
