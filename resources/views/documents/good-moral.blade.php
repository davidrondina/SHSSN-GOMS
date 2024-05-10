@php
    // use App\Models\AcademicYear;
    // use App\Models\Section;
    // use App\Models\SectionStudent;

    $student = $user->studentInfo;
    $is_male = $student->sex === 'Male';

    // $current_year = AcademicYear::where('is_current', true)->first();
    // $section = Section::with([
    //     'students' => function ($query) use ($student) {
    //         $query->where('student_id', $student->id);
    //     },
    // ])
    //     ->where('academic_year_id', $current_year->id)
    //     ->first();

@endphp

<x-document.base :title="__('Certificate of Good Moral')">
    @push('head')
        <style>
            @font-face {
                font-family: 'Bookman Old Style';
                src: url({{ storage_path('fonts/bookman-old-style-regular.ttf') }});
                font-style: normal;
                font-weight: normal;
            }

            @font-face {
                font-family: 'Bookman Old Style';
                src: url({{ storage_path('fonts/bookman-old-style-bold.otf') }});
                font-style: normal;
                font-weight: bold;
            }

            body {
                font-family: 'Bookman Old Style', serif;
            }
        </style>
    @endpush

    <main>
        <div id="canvas">
            {{-- <x-document.header /> --}}

            <x-document.header-b />

            {{-- <hr style="border: 2px solid black;"> --}}

            <div style="float: right; padding-top: 2.5rem;">
                <div>Date <span
                        style="display: inline-block; width: 12rem; border-bottom: 1px solid black; text-align: center;">{{ now()->format('M d, Y') }}</span>
                </div>
            </div>

            <div style="clear: right; padding-top: 2.5rem;">
                <h1
                    style="text-align: center; letter-spacing: .75em; font-size: 1.5rem; line-height: 2rem; font-weight: 700;">
                    CERTIFICATION</h1>
            </div>

            <div style="padding-top: 2.5rem;">
                <div style="font-size: 12pt; display: flex; flex-direction: column; row-gap: 1.5rem; text-wrap: wrap;">
                    <p>To whom it may concern:</p>
                    {{-- <p style="text-indent: 3.5rem;">This is to certify that <span
                            style="display: inline-block; min-width: 400px; border-bottom: 1px solid black; font-weight: 700; text-align: center; font-size: 1rem; line-height: 1.5rem">{{ $student->getFullName() }}</span>
                        is
                        a student of this institution this school year <span
                            style="font-weight: 700; text-decoration: underline;">{{ $current_year->getFullYear() }}</span>
                        . He/she
                        belongs to
                        <span style="font-weight: 700; text-decoration: underline;">{{ $section->name }}</span> .
                    </p>
                    <p style="text-indent: 3.5rem;">
                        This certifies further he/she is of good moral character and had not been charged of any
                        violation
                        against the School Rules and Regulations.
                    </p>
                    <p style="text-indent: 3.5rem;">
                        This certification is issued upon verbal request of said student for legal purposes.
                    </p> --}}

                    <p style="text-indent: 3.5rem;">
                        This is to certify that <span
                            style="display: inline-block; min-width: 400px; border-bottom: 1px solid black; font-weight: 700; text-align: center; font-size: 1rem; line-height: 1.5rem">{{ $student->getFullName() }}</span>
                        is a {{ $good_moral->is_undergraduate ? 'student' : 'graduate' }} of this school during school
                        year <span
                            style="font-weight: 700; text-decoration: underline;">{{ $good_moral->academicYear->getfullYear() }}.</span>
                    </p>

                    <p style="text-indent: 3.5rem;">
                        During {{ $is_male ? 'his' : 'her' }} <span
                            style="display: inline-block; min-width: 100px; border-bottom: 1px solid black; font-weight: 700; text-align: center; text-indent; 0; font-size: 1rem; line-height: 1.5rem">{{ $good_moral->duration_as_student }}</span>
                        {{ $good_moral->is_duration_month ? 'months' : 'years' }} in this school, I know
                        {{ $is_male ? 'him' : 'her' }} to be of <strong>good moral
                            character</strong> and
                        law-abiding citizen. {{ $is_male ? 'He' : 'She' }} is cooperative, understanding, and can get
                        among well with
                        teachers and students.
                    </p>

                    <p style="text-indent: 3.5rem;">This certification is being issued upon the request of the student
                        concerned.</p>

                    <p style="text-indent: 3.5rem;"></p>
                </div>
            </div>

            <div style="float: right;">
                <div style="font-size: 12pt; margin: auto; text-align: center;">
                    <div style="padding: 0 0 0.25rem 0;">
                        <img src="{{ public_path('images/deped-logo.png') }}" alt="Signature"
                            style="width: 300px; height: 6rem;">
                    </div>
                    <span
                        style="display: block; padding-top: 0.25rem; font-weight: 700; text-decoration: underline;">ISMAEL
                        T. SANTOS, RPM</span>
                    <span style="display: block; padding-top: 0.25rem;">Guidance Councelor/Master Teacher II</span>
                </div>
            </div>

            {{-- <div style="float: right;">
                <div style="font-size: 12pt; margin: auto; text-align: center;">
                    <div style="padding: 0 0 0.25rem 0;">
                        <img src="{{ public_path('images/deped-logo.png') }}" alt="Signature"
                            style="width: 300px; height: 6rem;">
                    </div>
                    <span
                        style="display: block; padding-top: 0.25rem; min-width: 300px; font-weight: 700; border-bottom: 1px solid black;">ISMAEL
                        T. SANTOS</span>
                    <span style="display: block; padding-top: 0.25rem;">Guidance Councelor/Master Teacher II</span>
                </div>
            </div> --}}

            {{-- <x-document.end /> --}}
        </div>
    </main>
</x-document.base>
