@php
    use App\Enums\UserRejectionReason;
@endphp

<x-app.admin.main-container>
    <x-app.page-header :show_back_btn="true" :back_btn_url="route('admin.users.unverified.index')" />

    <x-card class="px-6 py-5 flex flex-col gap-y-5">
        <div class="card-title justify-between">
            <div class="flex flex-col gap-y-2">
                <h1 class="font-bold text-2xl">
                    {{ $user->surname .
                        ($user->suffix ? ' ' . $user->suffix . ', ' : ', ') .
                        $user->first_name .
                        ($user->middle_name ? ' ' . $user->middle_name : '') }}
                </h1>
                <div class="flex flex-col gap-y-1">
                    <p class="font-semibold uppercase text-sm">LRN: <span class="text-gray-500">{{ $user->lrn }}</span>
                    </p>
                    @if ($student_has_user)
                        <p class="text-sm text-primary"><i class="fa-solid fa-circle-info"></i> An existing user is
                            already registered under the name of <span
                                class="font-semibold">{{ $student_has_user->getFullName() }}</span></p>
                    @else
                        @if ($user_has_lrn)
                            <p class="text-sm text-primary"><i class="fa-solid fa-circle-info"></i> Student record with
                                this LRN already exists under the name of {{ $user_has_lrn->getFullName() }}, but does
                                not have an account registered.</p>
                        @else
                            <p class="text-sm text-primary"><i class="fa-solid fa-circle-info"></i> This user is not
                                registered and has no student record.</p>
                        @endif
                    @endif

                </div>
            </div>

            <div class="flex gap-x-3">
                @if (!$student_has_user)
                    <x-confirm-modal :type="__('success')">
                        <button @click="open = !open" class="btn btn-sm btn-success"><i
                                class="fa-solid fa-circle-check font-normal"></i>Approve
                        </button>

                        <x-slot name="header">
                            Approve User?
                        </x-slot>
                        <x-slot name="body">
                            @if ($user_has_lrn)
                                <p class="text-gray-500 text-sm mb-3">An existing student LRN matches this user's LRN.
                                    You are
                                    about to register this user under this record:</p>

                                <div class="mb-6 grid grid-cols-2 font-semibold text-sm uppercase">
                                    <div class="flex flex-col gap-y-2">
                                        <span class="text-gray-500">Name</span>
                                        <span>{{ $user_has_lrn->getFullName() }}</span>
                                    </div>
                                    <div class="flex flex-col gap-y-2">
                                        <span class="text-gray-500">LRN</span>
                                        <span>{{ $user_has_lrn->lrn }}</span>
                                    </div>
                                </div>
                            @else
                                <p class="text-gray-500 text-sm">This will create a user account & other records
                                    for the student.</p>
                            @endif
                        </x-slot>

                        <x-slot name="action">
                            <form action="{{ route('admin.users.unverified.approve', $user->id) }}" method="post"
                                class="flex">
                                @csrf

                                @if ($user_has_lrn)
                                    <input type="hidden" name="student_has_user" value="{{ $user_has_lrn->id }}">
                                @endif

                                <button class="flex btn btn-success font-poppins uppercase">Approve</button>
                            </form>
                        </x-slot>
                    </x-confirm-modal>
                @endif

                <x-modal.regular :icon="__('ri-close-circle-line')" :maxWidth="__('lg')">
                    <button @click="open = !open" class="btn btn-sm btn-error"><i
                            class="ri-close-circle-line font-normal"></i>Reject
                    </button>

                    <x-slot name="header">
                        Choose a reason for rejection
                    </x-slot>

                    <x-slot name="body">
                        <form action="{{ route('admin.users.unverified.reject', $user->id) }}" method="post"
                            class="flex flex-col gap-y-4">
                            @csrf
                            @method('PATCH')

                            <div>
                                <span class="block font-fs font-semibold text-sm uppercase">Reason</span>

                                <div class="mt-1 flex flex-col gap-y-2">
                                    @foreach (UserRejectionReason::cases() as $reason)
                                        <div class="flex gap-x-2">
                                            <x-form.radio-button id="{{ $reason->name }}" name="reason"
                                                value="{{ $reason->value }}" required />
                                            <x-form.input-label for="{{ $reason->name }}" :value="$reason->value" />
                                        </div>
                                    @endforeach

                                    <x-form.input-error :messages="$errors->get('reason')" class="mt-2" />
                                </div>
                            </div>

                            <div>
                                <x-form.input-label for="comment" :value="__('Additional Comment')" />

                                <textarea id="comment" name="additional_comment"
                                    class="mt-1 w-full h-[1000px] max-h-[200px] resize-none rounded border border-gray-300 shadow"
                                    placeholder="Write a comment" required></textarea>

                                <x-form.input-error :messages="$errors->get('additional_comment')" class="mt-2" />
                            </div>

                            <div class="flex justify-end">
                                <button class="flex btn btn-primary font-poppins uppercase">Submit</button>
                            </div>
                        </form>
                    </x-slot>
                </x-modal.regular>

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
                        <form action="{{ route('admin.users.unverified.destroy', $user->id) }}" method="post"
                            class="flex">
                            @csrf
                            @method('DELETE')

                            <button class="flex btn btn-warning font-poppins uppercase">Confirm</button>
                        </form>
                    </x-slot>
                </x-confirm-modal>
            </div>
        </div>

        <div class="mb-4 flex flex-col gap-y-2">
            <h2 class="font-bold text-lg">Personal Information</h2>

            <div class="grid grid-cols-2 gap-3 text-sm">
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Sex</p>
                    <p>{{ $user->sex }}</p>
                </div>
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Birthdate</p>
                    <p>{{ $user->birthdate }}</p>
                </div>
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Phone Number</p>
                    <p>{{ $user->phone_no }}</p>
                </div>
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Email Address</p>
                    <p>{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <div class="mb-4 flex flex-col gap-y-2">
            <h2 class="font-bold text-lg">Guardian Information</h2>

            <div class="grid grid-cols-2 gap-3 text-sm">
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Name</p>
                    <p>{{ $user->guardian->surname .
                        ($user->guardian->suffix ? ' ' . $user->guardian->suffix . ', ' : ', ') .
                        $user->guardian->first_name .
                        ($user->guardian->middle_name ? ' ' . $user->guardian->middle_name : '') }}
                    </p>
                </div>
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Phone Number</p>
                    <p>{{ $user->guardian->phone_no }}</p>
                </div>
                <div class="flex flex-col gap-y-2">
                    <p class="font-semibold">Email Address</p>
                    <p>{{ $user->guardian->email ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-y-2">
            <h2 class="font-bold text-lg">Proof Image <span class="text-sm text-gray-500 font-normal">(Click to view
                    full
                    image)</span></h2>
            <div class="w-60 aspect-square border border-gray-300">
                <a href="{{ $user->proof_image }}" class="venobox block">
                    <img src="{{ $user->proof_image }}" alt="" class="object-cover">
                </a>
            </div>
        </div>
    </x-card>

    @push('js')
        <script defer>
            const venobox = new VenoBox({
                selector: '.venobox',
                spinner: 'circle-fade',
            });
        </script>
    @endpush
</x-app.admin.main-container>
