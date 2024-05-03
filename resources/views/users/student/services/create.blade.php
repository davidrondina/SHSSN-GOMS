@php
    use App\Models\AcademicYear;
    use App\Models\Section;
    use App\Models\SectionStudent;
    use App\Enums\DocumentType;

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

                    <div class="flex flex-col gap-y-4">
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
                    </div>
                @break

                @default
            @endswitch

            <div>
                <x-primary-button>Submit</x-primary-button>
            </div>
        </form>
    </x-card>
</x-app.student.main-container>
