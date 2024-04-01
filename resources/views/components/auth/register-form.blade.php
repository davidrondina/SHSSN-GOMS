<?php
use App\Enums\Sex;
use App\Enums\Suffix;
?>

<form x-data="studentRegForm()" action="{{ route('student-register.store') }}" method="POST" enctype="multipart/form-data"
    class="flex flex-col gap-y-7">
    @csrf

    <ul class="steps steps-vertical lg:steps-horizontal">
        <li :class="step >= 1 ? 'step-primary' : ''" class="step">Account Info</li>
        <li :class="step >= 2 ? 'step-primary' : ''" class="step">Personal Info</li>
        <li :class="step >= 3 ? 'step-primary' : ''" class="step">Guardian Info</li>
        <li :class="step === 4 ? 'step-primary' : ''" class="step">Confirm</li>
    </ul>

    {{-- <input type="file" name="proof_image" id="">
    <x-primary-button>Go</x-primary-button> --}}

    <section x-transition.duration.400ms x-claok x-show="step === 1" class="flex flex-col gap-y-4">
        <h2 class="text-xl font-bold">Account Information</h2>

        <div>
            <x-form.input-label for="email" :value="__('Email address')" />

            <x-form.text-input @change="errors.account.email = null" x-model="data.account.email" id="email"
                class="block mt-1 w-full" type="email" name="student_email" required autocomplete="current-password"
                placeholder="juandc@gmail.com" />

            <p class="text-sm text-red-600"><span x-text="errors.account.email ? errors.account.email : ''"></span>
            </p>
        </div>

        <div>
            <x-form.input-label for="password" :value="__('Password')" />

            <x-form.text-input @change="errors.account.password = null" x-model="data.account.password" id="password"
                class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password"
                placeholder="Enter your account password" />

            <p class="text-sm text-red-600"><span
                    x-text="errors.account.password ? errors.account.password : ''"></span>
            </p>
        </div>

        <div>
            <x-form.input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-form.text-input @change="errors.account.password_confirmation = null"
                x-model="data.account.password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                type="password" name="password_confirmation" required autocomplete="current-password"
                placeholder="Re-enter your account password" />

            <p class="text-sm text-red-600"><span
                    x-text="errors.account.password_confirmation ? errors.account.password_confirmation : ''"></span>
            </p>
        </div>

        <div>
            <span class="text-sm">Password must be at least 8 characters.</span>
        </div>
    </section>

    <section x-transition.duration.400ms x-cloak x-show="step === 2" class="flex flex-col gap-y-4">
        <h2 class="text-xl font-bold">Personal Information (Student)</h2>

        <div class="flex gap-x-2">
            <div class="flex-1">
                <x-form.input-label for="student_first_name" :value="__('First Name')" />
                <x-form.text-input @change="errors.student.first_name = null" x-model="data.student.first_name"
                    id="student_first_name" class="block mt-1 w-full" type="text" name="student_first_name"
                    :value="old('student_first_name')" required autofocus autocomplete="on" placeholder="Juan" />

                <p class="text-sm text-red-600"><span
                        x-text="errors.student.first_name ? errors.student.first_name : ''"></span>
                </p>
            </div>
            <div class="flex-1">
                <x-form.input-label for="middle_name" :value="__('Middle Name')" class="optional" />
                <x-form.text-input @change="errors.student.middle_name = null" x-model="data.student.middle_name"
                    id="student_middle_name" class="block mt-1 w-full" type="text" name="student_middle_name"
                    :value="old('student_middle_name')" autofocus autocomplete="on" placeholder="Josephito" />

                <p class="text-sm text-red-600"><span
                        x-text="errors.student.middle_name ? errors.student.middle_name : ''"></span>
                </p>
            </div>
        </div>

        <div class="flex gap-x-2">
            <div class="flex-1">
                <x-form.input-label for="surname" :value="__('Surname')" />
                <x-form.text-input @change="errors.student.surname = null" x-model="data.student.surname"
                    id="student_surname" class="block mt-1 w-full" type="text" name="student_surname"
                    :value="old('student_surname')" required autofocus autocomplete="on" placeholder="Dela Cruz" />

                <p class="text-sm text-red-600"><span
                        x-text="errors.student.surname ? errors.student.surname : ''"></span>
                </p>
            </div>
            <div class="flex-1">
                <x-form.input-label for="student_suffix" :value="__('Suffix (Leave blank if none)')" />
                <x-form.select.select-input @change="errors.student.suffix = null" x-model="data.student.suffix"
                    name="student_suffix" id="student_suffix" class="block mt-1 w-full">
                    <x-form.select.select-option :disabled="true" :selected="true" :option_name="__('Select a suffix')" />

                    @foreach (Suffix::cases() as $suf)
                        <x-form.select.select-option :value="$suf" :option_name="$suf" />
                    @endforeach
                </x-form.select.select-input>

                <p class="text-sm text-red-600"><span
                        x-text="errors.student.suffix ? errors.student.suffix : ''"></span>
                </p>
            </div>
        </div>

        <div>
            <x-form.input-label for="lrn" :value="__('LRN')" />
            <x-form.text-input @change="errors.student.lrn = null" x-model="data.student.lrn" id="lrn"
                class="block mt-1 w-full" type="text" name="lrn" :value="old('lrn')" required autofocus
                autocomplete="on" placeholder="107879070458" />

            <p class="text-sm text-red-600"><span x-text="errors.student.lrn ? errors.student.lrn : ''"></span>
            </p>
        </div>

        <div>
            <span class="block font-fs font-semibold text-sm uppercase">Sex</span>
            <div class="flex gap-x-8">
                <div class="flex gap-x-2">
                    <x-form.radio-button @change="errors.student.sex = null" x-model="data.student.sex"
                        id="sex_male" name="sex" value="{{ Sex::MALE }}" required />
                    <x-form.input-label for="sex_male" :value="Sex::MALE" />
                </div>

                <div class="flex gap-x-2">
                    <x-form.radio-button x-model="data.student.sex" id="sex_female" name="sex"
                        value="{{ Sex::FEMALE }}" />
                    <x-form.input-label for="sex_female" :value="Sex::FEMALE" />
                </div>
            </div>

            <p class="text-sm text-red-600"><span x-text="errors.student.sex ? errors.student.sex : ''"></span>
            </p>
        </div>

        <div class="flex gap-x-2">
            <div class="flex-1">
                <x-form.input-label for="birthdate" :value="__('Birthdate')" />
                <x-form.date-input @change="errors.student.birthdate = null" x-model="data.student.birthdate"
                    id="birthdate" name="birthdate" class="block mt-1 w-full" required />

                <p class="text-sm text-red-600"><span
                        x-text="errors.student.birthdate ? errors.student.birthdate : ''"></span>
                </p>
            </div>

            <div class="flex-1">
                <x-form.input-label for="address" :value="__('Address')" />
                <x-form.text-input @change="errors.student.address = null" x-model="data.student.address"
                    id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"
                    required autofocus autocomplete="on"
                    placeholder="Blk. 1, Lot 2, Grove St., Brgy. Molino 3, Bacoor, Cavite" />

                <p class="text-sm text-red-600"><span
                        x-text="errors.student.address ? errors.student.address : ''"></span>
                </p>
            </div>
        </div>

        <div>
            <x-form.input-label for="student_phone_no" :value="__('Phone Number')" class="optional" />
            <x-form.text-input @change="errors.student.phone_no = null" x-model="data.student.phone_no"
                id="student_phone_no" class="block mt-1 w-full" type="text" name="student_phone_no"
                :value="old('student_phone_no')" autofocus autocomplete="one" placeholder="09123456789" required />

            <p class="text-sm text-red-600"><span
                    x-text="errors.student.phone_no ? errors.student.phone_no : ''"></span>
            </p>
        </div>

        <div class="flex flex-col gap-y-2">
            <span class="block font-fs font-semibold text-sm uppercase">Proof Image</span>

            <div class="flex flex-col items-center justify-center w-full">
                <div x-show="!data.student.proof_image" class="w-full">
                    <label for="dropzone-file"
                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 hover:bg-gray-100">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click
                                    to
                                    upload</span></p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or JPEG (MAX. 5MB)</p>
                        </div>
                        <input type="file" name="proof_image" @change="previewUpload($event)" id="dropzone-file"
                            class="hidden" required />
                    </label>
                </div>

                <template x-if="data.student.proof_image">
                    <div class="w-full flex flex-col items-center gap-y-4">
                        <img :src="data.student.proof_image" alt="Image upload" class="w-32 aspect-square">

                        <button @click="clearUpload()" type="button"
                            class="btn btn-secondary btn-sm uppercase inline-flex items-center font-semibold">Clear</button>
                    </div>
                </template>

                <p class="text-sm text-red-600"><span
                        x-text="errors.student.proof_image ? errors.student.proof_image : ''"></span>
                </p>
            </div>
        </div>
    </section>

    <section x-transition.duration.400ms x-cloak x-show="step === 3" class="flex flex-col gap-y-4">
        <h2 class="text-xl font-bold">Guardian Information</h2>

        <div class="flex gap-x-2">
            <div class="flex-1">
                <x-form.input-label for="guardian_first_name" :value="__('First Name')" />
                <x-form.text-input @change="errors.guardian.first_name = null" x-model="data.guardian.first_name"
                    id="guardian_first_name" class="block mt-1 w-full" type="text" name="guardian_first_name"
                    :value="old('guardian_first_name')" required autofocus autocomplete="on" placeholder="Juan" />

                <p class="text-sm text-red-600"><span
                        x-text="errors.guardian.first_name ? errors.guardian.first_name : ''"></span>
                </p>
            </div>
            <div class="flex-1">
                <x-form.input-label for="guardian_middle_name" :value="__('Middle Name')" class="optional" />
                <x-form.text-input @change="errors.guardian.middle_name = null" x-model="data.guardian.middle_name"
                    id="guardian_middle_name" class="block mt-1 w-full" type="text" name="guardian_middle_name"
                    :value="old('guardian_middle_name')" autofocus autocomplete="on" placeholder="Josephito" />

                <p class="text-sm text-red-600"><span
                        x-text="errors.guardian.middle_name ? errors.guardian.middle_name : ''"></span>
                </p>
            </div>
        </div>

        <div class="flex gap-x-2">
            <div class="flex-1">
                <x-form.input-label for="guardian_surname" :value="__('Last Name')" />
                <x-form.text-input @change="errors.guardian.surname = null" x-model="data.guardian.surname"
                    id="guardian_surname" class="block mt-1 w-full" type="text" name="guardian_surname"
                    :value="old('guardian_surname')" required autofocus autocomplete="on" placeholder="Dela Cruz" />

                <p class="text-sm text-red-600"><span
                        x-text="errors.guardian.surname ? errors.guardian.surname : ''"></span>
                </p>
            </div>
            <div class="flex-1">
                <x-form.input-label for="guardian_suffix" :value="__('Suffix (Leave blank if none)')" />
                <x-form.select.select-input @change="errors.guardian.suffix = null" name="guardian_suffix"
                    x-model="data.guardian.suffix" id="guardian_suffix" class="block mt-1 w-full">
                    <x-form.select.select-option :disabled="true" :selected="true" :option_name="__('Select a suffix')" />

                    @foreach (Suffix::cases() as $suf)
                        <x-form.select.select-option :value="$suf" :option_name="$suf" />
                    @endforeach
                </x-form.select.select-input>

                <p class="text-sm text-red-600"><span
                        x-text="errors.guardian.suffix ? errors.guardian.suffix : ''"></span>
                </p>
            </div>
        </div>

        <div>
            <x-form.input-label for="guardian_phone_no" :value="__('Phone Number')" />
            <x-form.text-input @change="errors.guardian.phone_no = null" x-model="data.guardian.phone_no"
                id="guardian_phone_no" class="block mt-1 w-full" type="text" name="guardian_phone_no"
                :value="old('phone_no')" required autofocus autocomplete="on" placeholder="09123456789" />

            <p class="text-sm text-red-600"><span
                    x-text="errors.guardian.phone_no ? errors.guardian.phone_no : ''"></span>
            </p>
        </div>

        <div>
            <x-form.input-label for="guardian_email" :value="__('Email Address')" class="optional" />
            <x-form.text-input @change="errors.guardian.email = null" x-model="data.guardian.email"
                id="guardian_email" class="block mt-1 w-full" type="email" name="guardian_email"
                :value="old('guardian_email')" autofocus autocomplete="on" placeholder="juandelacruz@example.com" />

            <p class="text-sm text-red-600"><span x-text="errors.guardian.email ? errors.guardian.email : ''"></span>
            </p>
        </div>
    </section>

    <section x-transition.duration.400ms x-cloak x-show="step === 4" class="flex flex-col gap-y-4">
        <h2 class="text-xl font-bold">Please confirm the following information:</h2>

        <div class="flex flex-col gap-y-10 text-sm">
            <div class="flex flex-col gap-y-3">
                <h3 class="font-bold text-base uppercase">Student information</h3>

                <div class="flex-1 flex flex-col gap-y-1">
                    <span class="font-fs font-semibold text-sm uppercase">LRN</span>
                    <span x-text="data.student.lrn"></span>
                </div>

                <div class="flex gap-x-2 flex-wrap">
                    <div class="flex-1 flex flex-col gap-y-1">
                        <span class="font-fs font-semibold text-sm uppercase">First Name</span>
                        <span x-text="data.student.first_name"></span>
                    </div>

                    <div class="flex-1 flex flex-col gap-y-1">
                        <span class="font-fs font-semibold text-sm uppercase">Middle Name</span>
                        <span x-text="data.student.middle_name ? data.student.middle_name : 'N/A'"></span>
                    </div>

                    <div class="flex-1 flex flex-col gap-y-1">
                        <span class="font-fs font-semibold text-sm uppercase">Surname</span>
                        <span x-text="data.student.surname"></span>
                    </div>

                    <div class="flex-1 flex flex-col gap-y-1">
                        <span class="font-fs font-semibold text-sm uppercase">Suffix</span>
                        <span x-text="data.student.suffix ? data.student.suffix : 'N/A'"></span>
                    </div>
                </div>

                <div class="flex gap-x-2 flex-wrap">
                    <div class="flex-1 flex flex-col gap-y-1">
                        <span class="font-fs font-semibold text-sm uppercase">Sex</span>
                        <span x-text="data.student.sex"></span>
                    </div>

                    <div class="flex-1 flex flex-col gap-y-1">
                        <span class="font-fs font-semibold text-sm uppercase">Address</span>
                        <span x-text="data.student.address"></span>
                    </div>

                    <div class="flex-1 flex flex-col gap-y-1">
                        <span class="font-fs font-semibold text-sm uppercase">Birthdate</span>
                        <span x-text="data.student.birthdate"></span>
                    </div>

                    <div class="flex-1 flex flex-col gap-y-1">
                        <span class="font-fs font-semibold text-sm uppercase">Phone No.</span>
                        <span x-text="data.student.phone_no ? data.student.phone_no : 'N/A'"></span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-y-3">
                <h3 class="font-bold text-base uppercase">Guardian Information</h3>

                <div class="flex gap-x-2 flex-wrap">
                    <div class="flex-1 flex flex-col gap-y-1">
                        <span class="font-fs font-semibold text-sm uppercase">First Name</span>
                        <span x-text="data.guardian.first_name"></span>
                    </div>

                    <div class="flex-1 flex flex-col gap-y-1">
                        <span class="font-fs font-semibold text-sm uppercase">Middle Name</span>
                        <span x-text="data.guardian.middle_name ? data.guardian.middle_name : 'N/A'"></span>
                    </div>

                    <div class="flex-1 flex flex-col gap-y-1">
                        <span class="font-fs font-semibold text-sm uppercase">Surname</span>
                        <span x-text="data.guardian.surname"></span>
                    </div>

                    <div class="flex-1 flex flex-col gap-y-1">
                        <span class="font-fs font-semibold text-sm uppercase">Suffix</span>
                        <span x-text="data.guardian.suffix ? data.guardian.suffix : 'N/A'"></span>
                    </div>
                </div>

                <div class="flex gap-x-2 flex-wrap">
                    <div class="flex-1 flex flex-col gap-y-1">
                        <span class="font-fs font-semibold text-sm uppercase">Email Address</span>
                        <span x-text="data.guardian.email ? data.guardian.email : 'N/A'"></span>
                    </div>

                    <div class="flex-1 flex flex-col gap-y-1">
                        <span class="font-fs font-semibold text-sm uppercase">Phone No.</span>
                        <span x-text="data.guardian.phone_no ? data.guardian.phone_no : 'N/A'"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="flex justify-end items-center gap-x-4">
        <div x-cloak x-show="step > 1">
            <button type="button" @click="back()"
                class="btn inline-flex items-center uppercase font-fs">Back</button>
        </div>

        <div x-cloak x-show="step < 4">
            <x-primary-button type="button" @click="next()">
                <span x-text="step === 1 || step === 2 ? 'Next' : 'Done'"></span>
            </x-primary-button>
        </div>

        <div x-cloak x-show="step === 4">
            <x-primary-button>
                {{ __('Submit') }}
            </x-primary-button>
        </div>
    </div>
</form>
