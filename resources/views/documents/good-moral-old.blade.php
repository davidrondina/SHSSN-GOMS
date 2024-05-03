<x-document.base :title="__('Certificate of Good Moral')">
    <main x-data="goodMoralPDF">
        {{-- <button @click="save()" class="btn">Download here</button> --}}

        <div id="canvas">
            <x-document.header />

            <div class="flex justify-end pt-10">
                <div class="">Date <span class="inline-block w-48 border-b border-black text-center"></span></div>
            </div>
            <div class="flex items-center justify-center">
                <h1 class="tracking-[.75em] text-2xl font-bold pt-10">CERTIFICATION</h1>
            </div>
            <div class="flex flex-col items-center pt-10">
                <div class="text-[12pt] flex flex-col gap-y-6 text-wrap">
                    <p>To whom it may concern:</p>
                    <p class="indent-14">This is to certify that <span
                            class="inline-block min-w-[400px] border-b border-black font-bold text-center text-base">David
                            R.
                            Rondina</span> is
                        a student of this institution this school year <span
                            class="font-bold underline underline-offset-2">2024 -
                            2025</span> . He/she
                        belongs to
                        <span class="font-bold underline underline-offset-2">GAS 11-A</span> .
                    </p>
                    <p class="indent-14">
                        This certifies further he/she is of good moral character and had not been charged of any
                        violation
                        against the School Rules and Regulations.
                    </p>
                    <p class="indent-14">
                        This certification is issued upon verbal request of said student for legal purposes.
                    </p>
                </div>
            </div>
            <div class="flex justify-end">
                <div class="text-[12pt] flex flex-col items-center gap-y-1 text-center">
                    <div class="">
                        <img src="{{ public_path('images/deped-logo.png') }}" alt="Signature"
                            class="object-scale-down w-[300px] h-24">
                    </div>
                    <span class="block min-w-[300px] font-bold border-b border-black">ISMAEL T. SANTOS</span>
                    <span>Guidance Councelor/Master Teacher II</span>
                </div>
            </div>

            <x-document.end />
        </div>
    </main>

    {{-- @push('js')
        <script>
            const goodMoralPDF = () => {
                return {
                    save() {
                        const body = document.getElementById('canvas');
                        console.log('SAVING', body);
                        window.print();

                        // var options = {
                        //     margin: 1,
                        //     filename: 'good-moral-character.pdf',
                        //     image: {
                        //         type: 'jpeg',
                        //         quality: 0.98
                        //     },
                        //     html2canvas: {
                        //         dpi: 96,
                        //         letterRendering: true,
                        //     },
                        //     jsPDF: {
                        //         unit: 'in',
                        //         format: 'a4',
                        //         orientation: 'portrait',
                        //     },
                        // }

                        // html2pdf(body, options);
                    }
                }
            };
        </script>
    @endpush --}}
</x-document.base>
