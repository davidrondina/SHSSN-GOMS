<?php
use App\Enums\Sex;
use App\Enums\Suffix;
?>

<form x-data="studentRegForm" action="{{ route('register') }}" method="POST" class="flex flex-col gap-y-7">
    @csrf

    <section x-transition.duration.400ms x-claok x-show="step === 1" class="flex flex-col gap-y-4">
        <h2 class="text-xl font-bold">Account Information</h2>

        <div>
            <x-form.input-label for="email" :value="__('Email address')" />

            <x-form.text-input x-model="data.account.email" id="email" class="block mt-1 w-full" type="email"
                name="email" required autocomplete="current-password" placeholder="juandc@gmail.com" />

            <p class="text-sm text-red-600"><span x-text="errors.account.email ? errors.account.email : ''"></span>
            </p>
            <x-form.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-form.input-label for="password" :value="__('Password')" />

            <x-form.text-input x-model="data.account.password" id="password" class="block mt-1 w-full" type="password"
                name="password" required autocomplete="current-password" placeholder="Enter your account password" />

            <x-form.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-form.input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-form.text-input x-model="data.account.password_confirmation" id="password_confirmation"
                class="block mt-1 w-full" type="password" name="password_confirmation" required
                autocomplete="current-password" placeholder="Re-enter your account password" />

            <x-form.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div>
            <span class="text-sm">Password must be at least 8 characters.</span>
        </div>
    </section>

    <section x-transition.duration.400ms x-cloak x-show="step === 2" class="flex flex-col gap-y-4">
        <h2 class="text-xl font-bold">Student Information</h2>

        <div class="flex gap-x-2">
            <div class="flex-1">
                <x-form.input-label for="first_name" :value="__('First Name')" />
                <x-form.text-input x-model="data.student.firstName" id="first_name" class="block mt-1 w-full"
                    type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="on"
                    placeholder="Juan" />

                <x-form.input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>
            <div class="flex-1">
                <x-form.input-label for="middle_name" :value="__('Middle Name')" class="optional" />
                <x-form.text-input x-model="data.student.middleName" id="middle_name" class="block mt-1 w-full"
                    type="text" name="middle_name" :value="old('middle_name')" autofocus autocomplete="on"
                    placeholder="Josephito" />

                <x-form.input-error :messages="$errors->get('middle_name')" class="mt-2" />
            </div>
        </div>

        <div class="flex gap-x-2">
            <div class="flex-1">
                <x-form.input-label for="last_name" :value="__('Last Name')" />
                <x-form.text-input x-model="data.student.lastName" id="last_name" class="block mt-1 w-full"
                    type="text" name="last_name" :value="old('first_name')" required autofocus autocomplete="on"
                    placeholder="Dela Cruz" />

                <x-form.input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>
            <div class="flex-1">
                <x-form.input-label for="suffix" :value="__('Suffix (Leave blank if none)')" />
                <x-form.select.select-input x-model="data.student.suffix" id="suffix" class="block mt-1 w-full">
                    <x-form.select.select-option :disabled="true" :selected="true" :option_name="__('Select a suffix')" />

                    @foreach (Suffix::cases() as $suf)
                        <x-form.select.select-option :value="$suf" :option_name="$suf" />
                    @endforeach
                </x-form.select.select-input>

                <x-form.input-error :messages="$errors->get('middle_name')" class="mt-2" />
            </div>
        </div>

        <div>
            <x-form.input-label for="lrn" :value="__('LRN')" />
            <x-form.text-input x-model="data.student.lrn" id="lrn" class="block mt-1 w-full" type="text"
                name="lrn" :value="old('lrn')" required autofocus autocomplete="on" placeholder="107879070458" />

            <x-form.input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <div>
            <span class="block font-fs font-semibold text-sm uppercase">Sex</span>
            <div class="flex gap-x-8">
                <div class="flex gap-x-2">
                    <x-form.radio-button x-model="data.student.sex" id="sex_male" name="sex"
                        value="{{ Sex::MALE }}" required />
                    <x-form.input-label for="sex_male" :value="Sex::MALE" />
                </div>

                <div class="flex gap-x-2">
                    <x-form.radio-button x-model="data.student.sex" id="sex_female" name="sex"
                        value="{{ Sex::FEMALE }}" />
                    <x-form.input-label for="sex_female" :value="Sex::FEMALE" />
                </div>
            </div>

            <x-form.input-error :messages="$errors->get('sex')" class="mt-2" />
        </div>

        <div class="flex gap-x-2">
            <div class="flex-1">
                <x-form.input-label for="birthdate" :value="__('Birthdate')" />
                <x-form.date-input x-model="data.student.birthdate" id="birthdate" name="birthdate"
                    class="block mt-1 w-full" required />

                <x-form.input-error :messages="$errors->get('birthdate')" class="mt-2" />
            </div>

            <div class="flex-1">
                <x-form.input-label for="address" :value="__('Address')" />
                <x-form.text-input x-model="data.student.address" id="address" class="block mt-1 w-full"
                    type="text" name="address" :value="old('address')" required autofocus autocomplete="on"
                    placeholder="Blk. 1, Lot 2, Grove St., Brgy. Molino 3, Bacoor, Cavite" />

                <x-form.input-error :messages="$errors->get('address')" class="mt-2" />
            </div>
        </div>

        <div>
            <x-form.input-label for="contact_no" :value="__('Phone Number')" class="optional" />
            <x-form.text-input x-model="data.student.phoneNo" id="contact_no" class="block mt-1 w-full"
                type="text" name="contact_no" :value="old('contact_no')" required autofocus autocomplete="on"
                placeholder="09123456789" />

            <x-form.input-error :messages="$errors->get('contact_no')" class="mt-2" />
        </div>
    </section>

    <section x-transition.duration.400ms x-cloak x-show="step === 3" class="flex flex-col gap-y-4">
        <h2 class="text-xl font-bold">Guardian Information</h2>

        <div class="flex gap-x-2">
            <div class="flex-1">
                <x-form.input-label for="guardian_first_name" :value="__('First Name')" />
                <x-form.text-input x-model="data.guardian.firstName" id="guardian_first_name"
                    class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus
                    autocomplete="on" placeholder="Juan" />

                <x-form.input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>
            <div class="flex-1">
                <x-form.input-label for="guardian_middle_name" :value="__('Middle Name')" class="optional" />
                <x-form.text-input x-model="data.guardian.middleName" id="guardian_middle_name"
                    class="block mt-1 w-full" type="text" name="middle_name" :value="old('guardian_middle_name')" autofocus
                    autocomplete="on" placeholder="Josephito" />

                <x-form.input-error :messages="$errors->get('guardian_middle_name')" class="mt-2" />
            </div>
        </div>

        <div class="flex gap-x-2">
            <div class="flex-1">
                <x-form.input-label for="guradian_last_name" :value="__('Last Name')" />
                <x-form.text-input x-model="data.guardian.lastName" id="guradian_last_name" class="block mt-1 w-full"
                    type="text" name="guardian_last_name" :value="old('guardian_last_name')" required autofocus autocomplete="on"
                    placeholder="Dela Cruz" />

                <x-form.input-error :messages="$errors->get('guardian_last_name')" class="mt-2" />
            </div>
            <div class="flex-1">
                <x-form.input-label for="guardian_suffix" :value="__('Suffix (Leave blank if none)')" />
                <x-form.select.select-input x-model="data.guardian.suffix" id="guardian_suffix"
                    class="block mt-1 w-full">
                    <x-form.select.select-option :disabled="true" :selected="true" :option_name="__('Select a suffix')" />

                    @foreach (Suffix::cases() as $suf)
                        <x-form.select.select-option :value="$suf" :option_name="$suf" />
                    @endforeach
                </x-form.select.select-input>

                <x-form.input-error :messages="$errors->get('suffix')" class="mt-2" />
            </div>
        </div>

        <div>
            <x-form.input-label for="guardian_contact_no" :value="__('Phone Number')" />
            <x-form.text-input x-model="data.guardian.phoneNo" id="guardian_contact_no" class="block mt-1 w-full"
                type="text" name="contact_no" :value="old('contact_no')" required autofocus autocomplete="on"
                placeholder="09123456789" />

            <x-form.input-error :messages="$errors->get('contact_no')" class="mt-2" />
        </div>

        <div>
            <x-form.input-label for="email" :value="__('Email Address')" class="optional" />
            <x-form.text-input x-model="data.guardian.email" id="email" class="block mt-1 w-full" type="email"
                name="email" :value="old('email')" required autofocus autocomplete="on"
                placeholder="juandelacruz@example.com" />

            <x-form.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
    </section>

    <section x-transition.duration.400ms x-cloak x-show="step === 4" class="flex flex-col gap-y-4">
        <h2 class="text-xl font-bold">Confirm Information</h2>

        <div class="flex flex-col gap-y-6 text-sm">
            <div class="flex flex-col gap-y-3">
                <h3 class="font-bold text-base uppercase">Student information </h3>

                <div class="flex-1 flex flex-col gap-y-1">
                    <span class="font-fs font-semibold text-sm uppercase">LRN</span>
                    <span x-text="data.student.lrn"></span>
                </div>

                <div class="flex gap-x-2 flex-wrap">
                    <div class="flex-1 flex flex-col gap-y-1">
                        <span class="font-fs font-semibold text-sm uppercase">First Name</span>
                        <span x-text="data.student.firstName"></span>
                    </div>

                    <div class="flex-1 flex flex-col gap-y-1">
                        <span class="font-fs font-semibold text-sm uppercase">Middle Name</span>
                        <span x-text="data.student.middleName ? data.student.middleName : 'N/A'"></span>
                    </div>

                    <div class="flex-1 flex flex-col gap-y-1">
                        <span class="font-fs font-semibold text-sm uppercase">Last Name</span>
                        <span x-text="data.student.lastName"></span>
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
                        <span x-text="data.student.phoneNo ? data.student.phoneNo : 'N/A'"></span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-y-3">
                <h3 class="font-bold text-base uppercase">Guardian Information</h3>

                <div class="flex gap-x-2 flex-wrap">
                    <div class="flex-1 flex flex-col gap-y-1">
                        <span class="font-fs font-semibold text-sm uppercase">First Name</span>
                        <span x-text="data.guardian.firstName"></span>
                    </div>

                    <div class="flex-1 flex flex-col gap-y-1">
                        <span class="font-fs font-semibold text-sm uppercase">Middle Name</span>
                        <span x-text="data.guardian.middleName ? data.guardian.middleName : 'N/A'"></span>
                    </div>

                    <div class="flex-1 flex flex-col gap-y-1">
                        <span class="font-fs font-semibold text-sm uppercase">Last Name</span>
                        <span x-text="data.guardian.lastName"></span>
                    </div>

                    <div class="flex-1 flex flex-col gap-y-1">
                        <span class="font-fs font-semibold text-sm uppercase">Suffix</span>
                        <span x-text="data.guardian.suffix ? data.guardian.suffix : 'N/A'"></span>
                    </div>
                </div>

                <div class="flex gap-x-2 flex-wrap">
                    <div class="flex-1 flex flex-col gap-y-1">
                        <span class="font-fs font-semibold text-sm uppercase">Email Address</span>
                        <span x-text="data.guardian.email"></span>
                    </div>

                    <div class="flex-1 flex flex-col gap-y-1">
                        <span class="font-fs font-semibold text-sm uppercase">Phone No.</span>
                        <span x-text="data.guardian.phoneNo ? data.guardian.phoneNo : 'N/A'"></span>
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
