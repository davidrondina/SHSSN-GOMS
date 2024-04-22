@php
    use App\Enums\ComplaintReason;
@endphp

<x-app.faculty.main-container>
    <x-app.page-header :show_back_btn="true" :back_btn_url="route('faculty.complaints.index')" />

    <x-card class="px-6 py-5 flex flex-col gap-y-5">
        <div class="card-title">
            <h1 class="font-bold text-2xl">Complaint - Submit</h1>
        </div>
        <form action="{{ route('faculty.complaints.store') }}" method="post" class="flex flex-col gap-y-4">
            @csrf

            <div>
                <span class="block font-fs font-semibold text-sm uppercase">Respondent</span>
                <x-form.select2 id="student" name="student[]" class="mt-1">
                    @forelse ($students as $stu)
                        <option value="{{ $stu->id }}">
                            {{ $stu->getFullName() . ' (' . $stu->address . ')' }}
                        </option>
                    @empty
                    @endforelse
                </x-form.select2>

                <x-form.input-error :messages="$errors->get('student')" class="mt-2" />
            </div>

            <div>
                <span class="block font-fs font-semibold text-sm uppercase">Reason</span>

                <div class="mt-1 flex flex-col gap-y-2">
                    @foreach (ComplaintReason::cases() as $com)
                        <div class="flex gap-x-2">
                            <x-form.radio-button id="{{ $com->name }}" name="reason" value="{{ $com->value }}"
                                required />
                            <x-form.input-label for="{{ $com->name }}" :value="$com->value" />
                        </div>
                    @endforeach

                    <div x-data="{ open: false }" @click.outside="open = $refs.reasonOther.checked"
                        class="flex gap-x-4 items-center">
                        <div class="flex gap-x-2">
                            <x-form.radio-button @click="open = $refs.reasonOther.checked" x-ref="reasonOther"
                                id="reason_other" name="reason" value="{{ 'Other' }}" required />
                            <x-form.input-label for="reason_other" :value="__('Other (please specify):')" />
                        </div>
                        <div x-cloak x-show="open" class="flex flex-col gap-y-1">
                            <x-form.text-input id="other" class="block w-[1000px] max-w-sm" type="text"
                                name="other" :value="old('other')" ::required="open ? true : false" placeholder="Specify your reason" />

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

            <div>
                <x-primary-button>Create</x-primary-button>
            </div>
        </form>
    </x-card>

    @push('js')
        <script>
            $(document).ready(function() {
                $('#student').select2({
                    placeholder: 'Choose a respondent',
                    maximumSelectionLength: 1,
                    width: 'resolve',
                });
            });
        </script>
    @endpush
</x-app.faculty.main-container>
