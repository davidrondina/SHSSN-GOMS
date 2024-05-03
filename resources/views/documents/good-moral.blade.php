<x-document.base :title="__('Certificate of Good Moral')">
    <main>
        <div id="canvas">
            <x-document.header />

            <hr style="border: 2px solid black;">

            <div style="float: right; padding-top: 2.5rem;">
                <div>Date <span
                        style="display: inline-block; width: 12rem; border-bottom: 1px solid black; text-align: center;"></span>
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
                    <p style="text-indent: 3.5rem;">This is to certify that <span
                            style="display: inline-block; min-width: 400px; border-bottom: 1px solid black; font-weight: 700; text-align: center; font-size: 1rem; line-height: 1.5rem">David
                            R.
                            Rondina</span> is
                        a student of this institution this school year <span
                            style="font-weight: 700; text-decoration: underline;">2024
                            -
                            2025</span> . He/she
                        belongs to
                        <span style="font-weight: 700; text-decoration: underline;">GAS
                            11-A</span> .
                    </p>
                    <p style="text-indent: 3.5rem;">
                        This certifies further he/she is of good moral character and had not been charged of any
                        violation
                        against the School Rules and Regulations.
                    </p>
                    <p style="text-indent: 3.5rem;">
                        This certification is issued upon verbal request of said student for legal purposes.
                    </p>
                </div>
            </div>
            <div style="float: right;">
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
            </div>

            {{-- <x-document.end /> --}}
        </div>
    </main>
</x-document.base>
