@php
    use Carbon\Carbon;
@endphp

<x-document.base :title="__('Promissory Form')">
    @push('head')
        <style>
            @font-face {
                font-family: 'Calibri';
                src: url({{ storage_path('fonts/calibri-regular.ttf') }});
                font-style: normal;
                font-weight: normal;
            }

            @font-face {
                font-family: 'Calibri';
                src: url({{ storage_path('fonts/calibri-bold.ttf') }});
                font-style: normal;
                font-weight: bold;
            }

            @font-face {
                font-family: 'Old English Text MT';
                src: url({{ storage_path('fonts/old-english-text-mt.ttf') }});
                font-style: normal;
                font-weight: normal;
            }

            @font-face {
                font-family: 'Old English Text MT';
                src: url({{ storage_path('fonts/old-english-text-mt.ttf') }});
                font-style: normal;
                font-weight: bold;
            }

            @font-face {
                font-family: 'Cambria Font';
                src: url({{ storage_path('fonts/cambria.ttf') }});
                font-style: normal;
                font-weight: normal;
            }

            @font-face {
                font-family: 'Cambria Font';
                src: url({{ storage_path('fonts/cambria-bold.ttf') }});
                font-style: normal;
                font-weight: bold;
            }

            body {
                font-family: 'Calibri', sans-serif;
            }

            .font-old-english {
                font-family: 'Old English Text MT', serif;
            }

            .font-cambria {
                font-family: 'Cambria Font', serif;
            }
        </style>
    @endpush

    <main>
        <div id="canvas">
            <x-document.header-b />

            <hr style="border: 2px solid black;">

            {{-- <p>Is this text using calibri font? I guess so.</p> --}}

            <h1 style="font-size: 12pt; font-weight: bold; text-align: center; text-transform: uppercase;">Promissory
                Form</h1>

            <div style="font-size: 12pt;">
                <p style="margin-bottom: -2px;">
                    Name: <span
                        style="display: inline-block; min-width: 380px; border-bottom: 1px solid black; font-weight: 700; text-align: center; font-size: 1rem; line-height: 1.5rem">{{ $student->getFullName() }}</span>
                    Yr. & Sec.: <span
                        style="display: inline-block; min-width: 200px; border-bottom: 1px solid black; font-weight: 700; text-align: center; font-size: 1rem; line-height: 1.5rem">{{ $section?->name }}</span>
                </p>
                <p style="margin-bottom: -2px;">
                    Date: <span
                        style="display: inline-block; min-width: 130px; border-bottom: 1px solid black; font-weight: 700; text-align: center; font-size: 1rem; line-height: 1.5rem">{{ Carbon::parse($promissory_form->created_at)->format('M d, Y') }}</span>
                    Name of Parent/Guardian: <span
                        style="display: inline-block; min-width: 160px; border-bottom: 1px solid black; font-weight: 700; text-align: center; font-size: 1rem; line-height: 1.5rem"></span>
                    Tel. No: <span
                        style="display: inline-block; min-width: 100px; border-bottom: 1px solid black; font-weight: 700; text-align: center; font-size: 1rem; line-height: 1.5rem"></span>
                </p>
                <p>Relationship: <span
                        style="display: inline-block; min-width: 200px; border-bottom: 1px solid black; font-weight: 700; text-align: center; font-size: 1rem; line-height: 1.5rem"></span>
                </p>
                <p>
                    <span
                        style="margin-top: 24px; margin-bottom: 24px; display: block; w-full; border-bottom: 1px solid black; font-weight: 700; font-size: 1rem; line-height: 1.5rem"></span>
                    <span
                        style="margin-bottom: 24px; display: block; w-full; border-bottom: 1px solid black; font-weight: 700; font-size: 1rem; line-height: 1.5rem"></span>
                    <span
                        style="margin-bottom: 24px; display: block; w-full; border-bottom: 1px solid black; font-weight: 700; font-size: 1rem; line-height: 1.5rem"></span>
                    <span
                        style="display: block; w-full; border-bottom: 1px solid black; font-weight: 700; font-size: 1rem; line-height: 1.5rem"></span>
                </p>
            </div>

            <div style="padding-top: 1.5rem; float: right;">
                <div style="font-size: 12pt; margin: auto; text-align: center;">
                    {{-- <div style="padding: 0 0 0.25rem 0;">
                        <img src="{{ public_path('images/deped-logo.png') }}" alt="Signature"
                            style="width: 300px; height: 6rem;">
                    </div> --}}
                    <span
                        style="display: inline-block; min-width: 300px; border-bottom: 1px solid black; font-weight: 700; text-align: center; font-size: 1rem; line-height: 1.5rem">{{ $student->getFullName() }}</span>
                    <span style="display: block; padding-top: 0.25rem;">Pangalan at pirma ng Mag-aaral</span>
                </div>
            </div>

            <div style="padding-top: 6rem; font-size: 12pt;">
                <span style="display: block; margin-bottom: 36px;">Sinang-ayunan:</span>
                <div style="width: 100%;">
                    <div style="width: 45%; float: left;">
                        <span
                            style="display: inline-block; min-width: 100%; border-bottom: 1px solid black; font-weight: 700; text-align: center; font-size: 1rem;"><span
                                style="visibility: hidden;">A</span></span>
                        <span style="display: block; text-align: center;">Magulang</span>
                    </div>
                    <div style="width: 45%; float: right;">
                        <span
                            style="display: inline-block; min-width: 100%; border-bottom: 1px solid black; font-weight: 700; text-align: center; font-size: 1rem;"><span
                                style="visibility: hidden;">A</span>{{ $section?->adviser->user->profile->getFullName() }}</span>
                        <span style="display: block; text-align: center;">Tagapayo</span>
                    </div>
                </div>
            </div>

            {{-- <x-document.end /> --}}
        </div>
    </main>
</x-document.base>
