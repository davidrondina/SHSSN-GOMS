@php
    use App\Enums\ComplaintReason;
@endphp

<x-app.faculty.main-container>
    <x-app.page-header :show_back_btn="true" :back_btn_url="__('javascript:history.go(-1)')" />

    <x-card class="px-6 py-5 flex flex-col gap-y-5">
        <div class="card-title justify-between">
            <div class="flex flex-col gap-y-2">
                <h1 class="font-bold text-2xl">
                    {{ $student->getFullName() }}
                </h1>
                <p class="font-semibold text-sm">LRN: <span class="text-gray-500">{{ $student->lrn }}</span></p>

                @if ($student->isEnrolledToCurrentAY())
                    <p class="text-sm text-gray-500">Currently enrolled as <span class="text-neutral font-semibold">Grade
                            {{ $student->getCurrentGradeLvl() }}</span> student</p>
                @endif
            </div>

            <div class="flex gap-x-3">
                <x-modal.regular :icon="__('fa-solid fa-flag')" :maxWidth="__('lg')">
                    <button @click="open = !open" class="btn btn-sm btn-primary"><i
                            class="fa-solid fa-flag font-normal"></i>Submit a complaint
                    </button>

                    <x-slot name="header">
                        Submit a complaint
                    </x-slot>

                    <x-slot name="body">
                        <form action="{{ route('faculty.complaints.store') }}" method="post"
                            class="flex flex-col gap-y-4">
                            @csrf

                            <input type="hidden" name="student[]" value="{{ $student->id }}">

                            <div>
                                <span class="block font-fs font-semibold text-sm uppercase">Reason</span>

                                <div class="mt-1 flex flex-col gap-y-2">
                                    @foreach (ComplaintReason::cases() as $com)
                                        <div class="flex gap-x-2">
                                            <x-form.radio-button id="{{ $com->name }}" name="reason"
                                                value="{{ $com->value }}" required />
                                            <x-form.input-label for="{{ $com->name }}" :value="$com->value" />
                                        </div>
                                    @endforeach

                                    <div x-data="{ open: false }" @click.outside="open = $refs.reasonOther.checked"
                                        class="flex gap-x-4 items-center">
                                        <div class="flex gap-x-2">
                                            <x-form.radio-button @click="open = $refs.reasonOther.checked"
                                                x-ref="reasonOther" id="reason_other" name="reason"
                                                value="{{ 'Other' }}" required />
                                            <x-form.input-label for="reason_other" :value="__('Other (please specify):')" />
                                        </div>
                                        <div x-cloak x-show="open" class="flex flex-col gap-y-1">
                                            <x-form.text-input id="other" class="block w-[1000px] max-w-sm"
                                                type="text" name="other" :value="old('other')" ::required="open ? true : false"
                                                placeholder="Specify your reason" />

                                            <x-form.input-error :messages="$errors->get('other')" class="mt-2" />
                                        </div>
                                    </div>
                                    <x-form.input-error :messages="$errors->get('reason')" class="mt-2" />
                                </div>
                            </div>

                            <div>
                                <span class="block font-fs font-semibold text-sm uppercase">Additional Info</span>

                                <div class="mt-1 flex flex-col gap-y-2">
                                    <x-form.quill-editor :input_name="__('additional_info')" />
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button class="flex btn btn-primary font-poppins uppercase">Submit</button>
                            </div>
                        </form>
                    </x-slot>
                </x-modal.regular>
            </div>
        </div>

        <div class="mb-4 flex flex-col gap-y-2">
            <h2 class="font-bold text-lg">Personal Information</h2>

            <div class="grid grid-cols-2 gap-3 text-sm">
                @if ($student?->user?->profile)
                    <div class="flex flex-col gap-y-2">
                        <p class="font-semibold">Sex</p>
                        <p>{{ $student->user->profile->sex }}</p>
                    </div>
                @endif
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Birthdate</p>
                    <p>{{ $student->birthdate }}</p>
                </div>
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Phone Number</p>
                    <p>{{ $student->phone_no }}</p>
                </div>
                @if ($student->user)
                    <div class="flex flex-col gap-y-2">
                        <p class="font-semibold">Email Address</p>
                        <p>{{ $student->user->email }}</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="mb-4 flex flex-col gap-y-2">
            <h2 class="font-bold text-lg">Guardian Information</h2>

            <div class="grid grid-cols-2 gap-3 text-sm">
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Name</p>
                    <p>{{ $student->guardian->getFullName() }}</p>
                </div>
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Phone Number</p>
                    <p>{{ $student->guardian->phone_no }}</p>
                </div>
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Email Address</p>
                    <p>{{ $student->guardian->email ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-y-2">
            <div class="flex justify-between">
                <h2 class="font-bold text-lg">Sections</h2>
            </div>

            <x-table.wrapper>
                <x-table.head>
                    <tr>
                        <x-table.header-cell :scope="__('col')">Section Name</x-table.header-cell>
                        <x-table.header-cell :scope="__('col')">Adviser</x-table.header-cell>
                        <x-table.header-cell :scope="__('col')">Academic Year</x-table.header-cell>
                        {{-- <x-table.header-cell :scope="__('col')">Actions</x-table.header-cell> --}}
                    </tr>
                </x-table.head>
                <x-table.body>
                    @forelse ($student->sections as $sec)
                        <tr class="bg-white border-b">
                            <x-table.header-cell :scope="__('row')">{{ $sec->name }}</x-table.header-cell>
                            <x-table.regular-cell>{{ $sec->adviser->user->profile->getFullName() }}</x-table.regular-cell>
                            <x-table.regular-cell>{{ $sec->academicYear->getFullYear() }}</x-table.regular-cell>
                            {{-- <x-table.regular-cell class="regular-cell">
                                <div class="flex gap-x-3"><a href="{{ route('admin.sections.show', $sec->id) }}"
                                        class="btn btn-sm btn-accent"><i class="ri-eye-line font-normal"></i>View</a>
                                </div>
                            </x-table.regular-cell> --}}
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
    </x-card>

</x-app.faculty.main-container>
