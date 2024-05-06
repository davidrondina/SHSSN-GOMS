@php
    use Carbon\Carbon;
@endphp

<x-app.student.main-container>
    <x-app.page-header :show_back_btn="true" :back_btn_url="route('student.appointments.index')" />

    <x-card class="px-6 py-5 flex flex-col gap-y-5 divide-y divide-gray-300">
        <div class="card-title justify-between">
            <div class="flex flex-col gap-y-2">
                <h1 class="font-bold text-2xl">
                    Appointment - View
                </h1>
            </div>

            {{-- <div class="flex gap-x-3">
                <a href="{{ route('counselor.appointments.edit', $appointment->id) }}"
                    class="btn btn-sm btn-secondary inline-flex items-center font-semibold"><i
                        class="ri-edit-box-line font-normal"></i>Edit</a>

                <x-confirm-modal :type="__('warning')">
                    <button @click="open = !open" class="btn btn-sm btn-error"><i
                            class="ri-delete-bin-line font-normal"></i>Delete
                    </button>

                    <x-slot name="header">
                        Delete Appointment?
                    </x-slot>
                    <x-slot name="body">
                        <p class="text-gray-500 text-sm">This action cannot be undone.</p>
                    </x-slot>

                    <x-slot name="action">
                        <form action="{{ route('counselor.appointments.destroy', $appointment->id) }}" method="post"
                            class="flex">
                            @csrf
                            @method('DELETE')

                            <button class="flex btn btn-warning font-poppins uppercase">Confirm</button>
                        </form>
                    </x-slot>
                </x-confirm-modal>
            </div> --}}
        </div>

        <div class="pt-5 grid grid-cols-2 gap-3 text-sm uppercase font-fs">
            <div class="flex gap-x-3">
                <div class="self-start"><i class="fa-solid fa-user"></i></div>
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold text-gray-500">Respondent</p>
                    <p class="font-semibold">{{ $respondent->getFullName() }}</p>
                </div>
            </div>
            <div class="flex gap-x-3">
                <div class="self-start"><i class="fa-solid fa-user"></i></div>
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold text-gray-500">Complainant</p>
                    <p class="font-semibold">{{ $complaint->complainant->profile->getFullName() }}</p>
                </div>
            </div>
        </div>

        <div class="pt-5 flex gap-3 text-sm uppercase font-fs">
            <div class="w-auto self-start">
                <i class="fa-solid fa-clock"></i>
            </div>
            <div class="grid grid-cols-3">
                <div class="w-52 flex flex-col gap-y-2">
                    <p class="font-semibold text-gray-500">
                        {{ Carbon::parse($appointment->start_date)->format('l, d M Y') }}</p>
                    <p class="font-semibold">{{ Carbon::parse($appointment->start_date)->format('g:i A') }}</p>
                </div>
                <div class="flex justify-center items-center text-lg">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
                <div class="w-52 flex flex-col gap-y-2">
                    <p class="font-semibold text-gray-500">
                        {{ Carbon::parse($appointment->end_date)->format('l, d M Y') }}</p>
                    <p class="font-semibold">{{ Carbon::parse($appointment->end_date)->format('g:i A') }}</p>
                </div>
            </div>
        </div>

        <div class="pt-5 flex gap-3 text-sm uppercase font-fs">
            <div class="self-start">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="grid grid-cols-3">
                <div class="w-52 flex flex-col gap-y-2">
                    <p class="font-semibold text-gray-500">Reason</p>
                    <p class="font-semibold">{{ $complaint->reason }}</p>
                </div>
                <div class="flex justify-center items-center text-lg"></div>
                <div class="w-52 flex flex-col gap-y-2">
                    <p class="font-semibold text-gray-500">Additional Info</p>
                    <div class="prose prose-sm max-h-[400px] overflow-y-auto">{!! $complaint->additional_info !!}</div>
                </div>
            </div>
        </div>

        <div class="pt-5 flex gap-3 text-sm uppercase font-fs">
            <div class="self-start">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="w-full grid grid-cols-2 gap-3">
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold text-gray-500">Guardian Name</p>
                    <p class="font-semibold">{{ $respondent_guardian->getFullName() }}</p>
                </div>
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold text-gray-500">Guardian Mobile No.</p>
                    <p class="font-semibold">{{ $respondent_guardian->phone_no }}</p>
                </div>
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold text-gray-500">Guardian Email Address</p>
                    @if ($respondent_guardian->email && !$appointment->is_closed)
                        <div class="flex items-center gap-x-6">
                            <p class="font-semibold">{{ $respondent_guardian->email }}</p>
                            {{-- <form action="#" method="get">
                                <button class="btn btn-sm btn-primary"><i class="fa-solid fa-envelope"></i>Send
                                    Notice</button>
                            </form> --}}
                        </div>
                    @else
                        <p class="font-semibold">N/A</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- <div class="mb-4flex flex-col gap-y-2">
            <h2 class="font-bold text-lg">About the Complaint</h2>

            <div class="grid grid-cols-2 gap-3 text-sm">
                <div class="flex flex-col gap-y-1">
                    <p class="font-semibold">Reason</p>
                    <p>{{ $complaint->reason }}</p>
                </div>

                <div class="flex flex-col gap-y-1">
                    <p class="font-semibold">Complainant</p>
                    <div class="prose prose-sm max-h-[400px] overflow-y-auto">
                        {{ $complaint->complainant->profile->getFullName() }}
                    </div>
                </div>

                <div class="flex flex-col gap-y-1">
                    <p class="font-semibold">Additional Info</p>
                    <div class="prose prose-sm max-h-[400px] overflow-y-auto">
                        {!! $complaint->additional_info !!}
                    </div>
                </div>

                <div class="flex flex-col gap-y-1">
                    <p class="font-semibold">Date</p>
                    <div class="prose prose-sm max-h-[400px] overflow-y-auto">
                        {{ \Carbon\Carbon::parse($complaint->created_at)->format('M. d, Y') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4 flex flex-col gap-y-2">
            <h2 class="font-bold text-lg">Guardian Information</h2>

            <div class="grid grid-cols-2 gap-3 text-sm">
                <div class="flex flex-col gap-y-1">
                    <p class="font-semibold">Name</p>
                    <p>{{ $respondent->guardian->getFullName() }}</p>
                </div>
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Phone Number</p>
                    <p>{{ $respondent->guardian->phone_no }}</p>
                </div>
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Email Address</p>
                    <p>{{ $respondent->guardian->email ?? 'N/A' }}</p>
                </div>
            </div>
        </div> --}}

        {{-- <div class="flex flex-col gap-y-2">
            <div class="flex justify-between">
                <h2 class="font-bold text-lg">Sections</h2>
            </div>

            <x-table.wrapper>
                <x-table.head>
                    <tr>
                        <x-table.header-cell :scope="__('col')">Section Name</x-table.header-cell>
                        <x-table.header-cell :scope="__('col')">Adviser</x-table.header-cell>
                        <x-table.header-cell :scope="__('col')">Academic Year</x-table.header-cell>
                        <x-table.header-cell :scope="__('col')">Actions</x-table.header-cell>
                    </tr>
                </x-table.head>
                <x-table.body>
                    @forelse ($student->sections as $sec)
                        <tr class="bg-white border-b">
                            <x-table.header-cell :scope="__('row')">{{ $sec->name }}</x-table.header-cell>
                            <x-table.regular-cell>{{ $sec->adviser->user->profile->getFullName() }}</x-table.regular-cell>
                            <x-table.regular-cell>{{ $sec->academicYear->getFullYear() }}</x-table.regular-cell>
                            <x-table.regular-cell class="regular-cell">
                                <div class="flex gap-x-3"><a href="{{ route('admin.sections.show', $sec->id) }}"
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
        </div> --}}
    </x-card>
</x-app.student.main-container>
