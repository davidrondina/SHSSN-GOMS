@php
    use App\Models\AcademicYear;
    use App\Models\Section;
    use App\Models\SectionStudent;
    use App\Enums\DocumentType;

    $years = AcademicYear::latest()->get();

    $document_type = [
        'gm' => DocumentType::GM->value,
        'pn' => DocumentType::PN->value,
        'df' => DocumentType::DF->value,
        'fg' => DocumentType::FG->value,
    ][$type];
@endphp

<x-app.student.main-container>
    <x-app.page-header :show_back_btn="true" :back_btn_url="route('student.services.index')" />

    <x-card class="px-6 py-5 flex flex-col gap-y-5">
        <div class="card-title">
            <h1 class="font-bold text-2xl">Issuance of Certificate of Good Moral Character</h1>
        </div>
        <form action="{{ route('student.services.store') }}" method="post" class="flex flex-col gap-y-4">
            @csrf

            @switch($type)
                @case('gm')
                    @php
                        $current_year = AcademicYear::where('is_current', true)->first();
                        $student = $user->studentInfo;
                        $section = Section::with([
                            'students' => function ($query) use ($student) {
                                $query->where('student_id', $student->id);
                            },
                        ])
                            ->where('academic_year_id', $current_year->id)
                            ->first();
                    @endphp

                    <input type="hidden" name="type" value="{{ $document_type }}">
                    <input type="hidden" name="type_keyword" value="{{ $type }}">

                    <div>
                        <span class="block font-fs font-semibold text-sm uppercase">Are you an undergraduate?</span>
                        <div class="mt-1 flex gap-x-8">
                            <div class="flex gap-x-2">
                                <x-form.radio-button id="undergraduate" name="is_undergraduate" value="1" required />
                                <x-form.input-label for="undergraduate" :value="__('YES')" />
                            </div>

                            <div class="flex gap-x-2">
                                <x-form.radio-button id="not_undergraduate" name="is_undergraduate" value="0" />
                                <x-form.input-label for="not_undergraduate" :value="__('NO')" />
                            </div>
                        </div>

                        <x-form.input-error :messages="$errors->get('is_undergraduate')" class="mt-2" />
                    </div>

                    <div>
                        <x-form.input-label for="academic_year" :value="__('Which academic year did you last enroll?')" />
                        <x-form.select.select-input name="academic_year" id="guardian_suffix" class="block mt-1 w-full"
                            required>
                            <x-form.select.select-option :disabled="true" :selected="true" :option_name="__('Choose an academic year')" />

                            @foreach ($years as $yr)
                            <x-form.select.select-option :value="$yr->id" :option_name="$yr->getfullYear()" />
                            @endforeach
                        </x-form.select.select-input>

                        <x-form.input-error :messages="$errors->get('academic_year')" class="mt-2" />
                    </div>

                    <div>
                        <x-form.input-label for="duration" :value="__('How many months/years have you stayed in this school?')" />

                        <x-form.text-input id="duration" class="block mt-1 w-full" type="text" name="duration"
                            value="{{ old('duration') }}" required autocomplete="current-password"
                            placeholder="Enter the subject name" />

                        <x-form.input-error :messages="$errors->get('duration')" class="mt-2" />
                    </div>

                    {{-- <div class="flex flex-col gap-y-4">
                        <x-alert :type="__('info')">
                            <div class="flex flex-col gap-y-1">
                                <p>Please confirm the following information before submitting this entry.</p>
                                <p>If you think that the information shown below is incorrect, please reach
                                    out to
                                    the guidance office.</p>
                            </div>
                        </x-alert>
                        <div class="grid grid-cols-3 uppercase">
                            <div class="w-52 flex flex-col gap-y-2">
                                <span class="font-semibold text-gray-500">Name</span>
                                <span class="font-semibold">{{ $student->getFullName() }}</span>
                            </div>
                            <div class="w-52 flex flex-col gap-y-2">
                                <span class="font-semibold text-gray-500">Academic Year</span>
                                <span class="font-semibold">{{ $current_year->getFullYear() }}</span>
                            </div>
                            <div class="w-52 flex flex-col gap-y-2">
                                <span class="font-semibold text-gray-500">Section</span>
                                <span class="font-semibold">{{ $section->name }}</span>
                            </div>
                        </div>
                    </div> --}}
                @break

                @default
            @endswitch

            <div>
                <x-primary-button>Submit</x-primary-button>
            </div>
        </form>
    </x-card>
</x-app.student.main-container>
