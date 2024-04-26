<x-app.counselor.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('Complaints')">
            <x-slot name="controls">
                <div class="flex items-center gap-x-4">
                    <form action="{{ route('counselor.complaints.index') }}" method="get" class="flex gap-x-2">
                        <x-form.select.select-input name="filter">
                            <x-form.select.select-option :disabled="true" :selected="true" :option_name="__('Filter by date submitted')" />
                            <x-form.select.select-option :value="__('latest')" :option_name="__('Latest')" />
                            <x-form.select.select-option :value="__('oldest')" :option_name="__('Oldest')" />
                        </x-form.select.select-input>

                        <x-primary-button>Go</x-primary-button>
                    </form>
                </div>
            </x-slot>
        </x-app.page-header>

        <x-tablist.container class="my-3">
            <x-tablist.item href="{{ route('counselor.complaints.index') }}"
                class="{{ Request::getRequestUri() === '/counselor/complaints' ? 'tab-active font-semibold' : '' }}">Pending</x-tablist.item>
            <x-tablist.item href="{{ route('counselor.complaints.index') . '?view=closed' }}"
                class="{{ Request::getRequestUri() === '/counselor/complaints?view=closed' ? 'tab-active font-semibold' : '' }}">Closed</x-tablist.item>
        </x-tablist.container>

        <x-table.wrapper>
            <x-table.head>
                <tr>
                    <x-table.header-cell :scope="__('col')">Complainant</x-table.header-cell>
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
                            :scope="__('row')">{{ $com->complainant->profile->getFullName() }}</x-table.header-cell>
                        <x-table.regular-cell>{{ $com->respondent->getFullName() }}</x-table.regular-cell>
                        <x-table.regular-cell>{{ $com->reason }}</x-table.regular-cell>
                        <x-table.regular-cell>{{ \Carbon\Carbon::parse($com->created_at)->format('M. d, Y') }}</x-table.regular-cell>
                        <x-table.regular-cell>
                            <div class="flex gap-x-3">
                                <a href="{{ route('counselor.complaints.show', $com->id) }}"
                                    class="btn btn-sm btn-accent"><i class="ri-eye-line font-normal"></i>View</a>
                                <a href="{{ route('faculty.complaints.edit', $com->id) }}"
                                    class="btn btn-sm btn-secondary inline-flex items-center font-semibold"><i
                                        class="ri-edit-box-line font-normal"></i>Edit</a>
                                @if (!$com->is_closed)
                                    <x-confirm-modal :type="__('warning')">
                                        <button @click="open = !open" class="btn btn-sm btn-warning"><i
                                                class="ri-close-large-fill font-normal"></i>Close
                                        </button>

                                        <x-slot name="header">
                                            Close Complaint?
                                        </x-slot>
                                        <x-slot name="body">
                                            <p class="text-gray-500 text-sm">This record will be archived.</p>
                                        </x-slot>

                                        <x-slot name="action">
                                            <form action="{{ route('counselor.complaints.close', $com->id) }}"
                                                method="post" class="flex">
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    class="flex btn btn-warning font-poppins uppercase">Confirm</button>
                                            </form>
                                        </x-slot>
                                    </x-confirm-modal>
                                @endif
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
                        <x-table.regular-cell colspan="5" class="text-center">No complaints
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
</x-app.counselor.main-container>
