@php
    use App\Models\AcademicYear;
    use App\Enums\DocumentType;
    use App\Models\EnrolledStudent;

    $document_type = [
        'gm' => DocumentType::GM->value,
        'pn' => DocumentType::PN->value,
        'df' => DocumentType::DF->value,
        'fg' => DocumentType::FG->value,
    ][$type];

    $current_year = AcademicYear::where('is_current', true)->first();

    $students = EnrolledStudent::where('academic_year_id', $current_year->id)
        ->with('student')
        ->get();
@endphp

<x-app.faculty.main-container>
    <x-app.page-header :show_back_btn="true" :back_btn_url="route('faculty.services.index')" />

    <x-card class="px-6 py-5 flex flex-col gap-y-5">
        <div class="card-title">
            <h1 class="font-bold text-2xl">Issuance of Promissory Form</h1>
        </div>
        <form action="{{ route('faculty.services.store') }}" method="post" class="flex flex-col gap-y-4">
            @csrf

            <input type="hidden" name="type" value="{{ $document_type }}">
            <input type="hidden" name="type_keyword" value="{{ $type }}">

            @switch($type)
                @case('pn')
                    <div>
                        <x-form.input-label for="student" :value="__('Select a student')" />

                        <x-form.select2 id="student" name="student[]" class="mt-1">
                            @forelse ($students as $stu)
                                <option value="{{ $stu->student->id }}">
                                    {{ $stu->student->lrn . ' - ' . $stu->student->getFullName() . ($stu->student->getCurrentSection() ? ' (' . $stu->student->getCurrentSection()->section->name . ')' : '') }}
                                </option>
                            @empty
                            @endforelse
                        </x-form.select2>

                        <x-form.input-error :messages="$errors->get('student')" class="mt-2" />
                    </div>
                @break
            @endswitch

            <div>
                <x-primary-button>Create</x-primary-button>
            </div>
        </form>
    </x-card>

    @push('js')
        <script>
            $(document).ready(function() {
                $('#student').select2({
                    placeholder: 'Select a student',
                    maximumSelectionLength: 1,
                    width: 'resolve',
                });
            });
        </script>
    @endpush
</x-app.faculty.main-container>
