<x-app.counselor.main-container>
    <x-app.page-header :show_back_btn="true" :back_btn_url="route('counselor.complaints.index')" />

    <x-card class="px-6 py-5 flex flex-col gap-y-5">
        <div class="card-title justify-between">
            <div class="flex flex-col gap-y-2">
                <h1 class="font-bold text-2xl">
                    Respondent: {{ $respondent->getFullName() }}
                </h1>
                <p class="font-semibold text-sm">LRN: <span class="text-gray-500">{{ $respondent->lrn }}</span></p>
            </div>

            <div class="flex gap-x-3">
                {{-- @if (!$student->isEnrolledToCurrentAY())
                    <x-modal.regular :icon="__('ri-checkbox-circle-line')">
                        <button @click="open = !open" class="btn btn-sm btn-success"><i
                                class="ri-checkbox-circle-line font-normal"></i>Enroll
                        </button>

                        <x-slot name="header">
                            Choose grade level & strand
                        </x-slot>

                        <x-slot name="body">
                            <form action="{{ route('admin.students.enroll', $student->id) }}" method="post"
                                class="flex flex-col gap-y-4">
                                @csrf

                                <div>
                                    <x-form.select.select-input name="grade_level" id="grade_level"
                                        class="block mt-1 w-full">
                                        <x-form.select.select-option :disabled="true" :selected="true"
                                            :option_name="__('Select grade level')" required s />

                                        <x-form.select.select-option :value="11" :option_name="__('Gr. 11')" />
                                        <x-form.select.select-option :value="12" :option_name="__('Gr. 12')" />
                                    </x-form.select.select-input>

                                    <x-form.input-error :messages="$errors->get('grade_level')" class="mt-2" />
                                </div>

                                <div>
                                    <x-form.select.select-input name="strand" id="strand" class="block mt-1 w-full">
                                        <x-form.select.select-option :disabled="true" :selected="true"
                                            :option_name="__('Select a strand')" />

                                        @foreach ($strands as $str)
                                            <x-form.select.select-option :value="$str->id" :option_name="$str->abbr" />
                                        @endforeach
                                    </x-form.select.select-input>
                                </div>

                                <div class="flex justify-end">
                                    <button class="flex btn btn-success font-poppins uppercase">Enroll</button>
                                </div>
                            </form>
                        </x-slot>
                    </x-modal.regular>
                @endif --}}

                <x-modal.regular :icon="__('fa-solid fa-calendar')">
                    <button @click="open = !open" class="btn btn-sm btn-accent"><i
                            class="fa-solid fa-calendar font-normal"></i>Schedule an appointment
                    </button>

                    <x-slot name="header">
                        Schedule an appointment
                    </x-slot>

                    <x-slot name="body">
                        <form action="{{ route('counselor.appointments.store') }}" method="post"
                            class="flex flex-col gap-y-4">
                            @csrf

                            <input type="hidden" name="complaint_id" value="{{ $complaint->id }}">

                            <div>
                                <x-form.input-label for="start_date" :value="__('Start Date')" />
                                <input type="datetime-local" id="start_date" name="start_date"
                                    class="block w-full mt-1 border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm"
                                    autofocus required />

                                <x-form.input-error :messages="$errors->get('start_date')" class="mt-2" />
                            </div>


                            <div>
                                <x-form.input-label for="end_date" :value="__('End Date')" />
                                <input type="datetime-local" id="end_date" name="end_date"
                                    class="block w-full mt-1 border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm"
                                    required />

                                <x-form.input-error :messages="$errors->get('end_date')" class="mt-2" />
                            </div>

                            <div class="flex justify-end">
                                <button class="flex btn btn-primary font-poppins uppercase">Create</button>
                            </div>
                        </form>
                    </x-slot>
                </x-modal.regular>

                {{-- <a href="#" class="btn btn-sm btn-accent inline-flex items-center font-semibold"><i
                        class="fa-solid fa-calendar font-normal"></i>Schedule an appointment</a> --}}

                <x-confirm-modal :type="__('warning')">
                    <button @click="open = !open" class="btn btn-sm btn-error"><i
                            class="ri-delete-bin-line font-normal"></i>Delete
                    </button>

                    <x-slot name="header">
                        Delete Faculty?
                    </x-slot>
                    <x-slot name="body">
                        <p class="text-gray-500 text-sm">This will delete their subjects, complaints, and advisory
                            sections.</p>
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
        </div>

        {{-- <div class="mb-4 flex flex-col gap-y-2">
            <h2 class="font-bold text-lg">Personal Information</h2>

            <div class="grid grid-cols-2 gap-3 text-sm">
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Sex</p>
                    <p>{{ $respondent->sex }}</p>
                </div>
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Birthdate</p>
                    <p>{{ $respondent->birthdate }}</p>
                </div>
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Phone Number</p>
                    <p>{{ $respondent->phone_no }}</p>
                </div>
                @if ($respondent->user)
                    <div class="flex flex-col gap-y-2">
                        <p class="font-semibold">Email Address</p>
                        <p>{{ $respondent->user->email }}</p>
                    </div>
                @endif
            </div>
        </div> --}}

        <div class="mb-4flex flex-col gap-y-2">
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
        </div>

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
</x-app.counselor.main-container>
