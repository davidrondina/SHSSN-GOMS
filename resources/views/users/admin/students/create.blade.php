@php
    use App\Enums\Sex;
    use App\Enums\Suffix;
@endphp

<x-app.admin.main-container>
    <x-app.page-header :show_back_btn="true" :back_btn_url="route('admin.students.index')" />

    <x-card class="px-6 py-5 flex flex-col gap-y-5">
        <div class="card-title">
            <h1 class="font-bold text-2xl">Student - Create</h1>
        </div>
        <form action="{{ route('admin.students.store') }}" method="post" class="flex flex-col gap-y-7">
            @csrf

            <section class="flex flex-col gap-y-4">
                <div class="flex flex-col gap-y-2">
                    <h2 class="text-xl font-bold">Personal Information</h2>
                    <p class="text-gray-500 text-sm">Provide the information of the student.</p>
                </div>

                <div class="flex gap-x-2">
                    <div class="flex-1">
                        <x-form.input-label for="student_first_name" :value="__('First Name')" />
                        <x-form.text-input id="student_first_name" class="block mt-1 w-full" type="text"
                            name="student_first_name" :value="old('student_first_name')" required autofocus autocomplete="on"
                            placeholder="Juan" />

                        <x-form.input-error :messages="$errors->get('student_first_name')" class="mt-2" />
                    </div>
                    <div class="flex-1">
                        <x-form.input-label for="student_middle_name" :value="__('Middle Name')" class="optional" />
                        <x-form.text-input id="student_middle_name" class="block mt-1 w-full" type="text"
                            name="student_middle_name" :value="old('student_middle_name')" autofocus autocomplete="on"
                            placeholder="Josephito" />

                        <x-form.input-error :messages="$errors->get('student_middle_name')" class="mt-2" />
                    </div>
                </div>

                <div class="flex gap-x-2">
                    <div class="flex-1">
                        <x-form.input-label for="student_surname" :value="__('Surname')" />
                        <x-form.text-input id="student_surname" class="block mt-1 w-full" type="text"
                            name="student_surname" :value="old('student_surname')" required autofocus autocomplete="on"
                            placeholder="Dela Cruz" />

                        <x-form.input-error :messages="$errors->get('student_surname')" class="mt-2" />
                    </div>
                    <div class="flex-1">
                        <x-form.input-label for="student_suffix" :value="__('Suffix (Leave blank if none)')" />
                        <x-form.select.select-input name="student_suffix" id="student_suffix" class="block mt-1 w-full">
                            <x-form.select.select-option :disabled="true" :selected="true" :option_name="__('Select a suffix')" />

                            @foreach (Suffix::cases() as $suf)
                                <x-form.select.select-option :value="$suf" :option_name="$suf" />
                            @endforeach
                        </x-form.select.select-input>

                        <x-form.input-error :messages="$errors->get('student_suffix')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-form.input-label for="lrn" :value="__('LRN')" />
                    <x-form.text-input id="lrn" class="block mt-1 w-full" type="text" name="lrn"
                        :value="old('lrn')" required autofocus autocomplete="on" placeholder="107879070458" />

                    <x-form.input-error :messages="$errors->get('lrn')" class="mt-2" />
                </div>

                <div>
                    <span class="block font-fs font-semibold text-sm uppercase">Sex</span>
                    <div class="flex gap-x-8">
                        <div class="flex gap-x-2">
                            <x-form.radio-button id="sex_male" name="sex" value="{{ Sex::MALE }}" required />
                            <x-form.input-label for="sex_male" :value="Sex::MALE" />
                        </div>

                        <div class="flex gap-x-2">
                            <x-form.radio-button id="sex_female" name="sex" value="{{ Sex::FEMALE }}" />
                            <x-form.input-label for="sex_female" :value="Sex::FEMALE" />
                        </div>
                    </div>

                    <x-form.input-error :messages="$errors->get('sex')" class="mt-2" />
                </div>

                <div class="flex gap-x-2">
                    <div class="flex-1">
                        <x-form.input-label for="birthdate" :value="__('Birthdate')" />
                        <x-form.date-input id="birthdate" name="birthdate" :value="old('birthdate')" class="block mt-1 w-full"
                            required />

                        <x-form.input-error :messages="$errors->get('birthdate')" class="mt-2" />
                    </div>

                    <div class="flex-1">
                        <x-form.input-label for="address" :value="__('Address')" />
                        <x-form.text-input id="address" class="block mt-1 w-full" type="text" name="address"
                            :value="old('address')" required autofocus autocomplete="on"
                            placeholder="Blk. 1, Lot 2, Grove St., Brgy. Molino 3, Bacoor, Cavite" />

                        <x-form.input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-form.input-label for="student_phone_no" :value="__('Phone Number')" />
                    <x-form.text-input id="student_phone_no" class="block mt-1 w-full" type="text"
                        name="student_phone_no" :value="old('student_phone_no')" autofocus autocomplete="one"
                        placeholder="09123456789" required />

                    <x-form.input-error :messages="$errors->get('student_phone_no')" class="mt-2" />
                </div>
            </section>

            <section class="flex flex-col gap-y-4">
                <div class="flex flex-col gap-y-2">
                    <h2 class="text-xl font-bold">Guardian Information</h2>
                    <p class="text-gray-500 text-sm">Provide the information of the student's guardian.</p>
                </div>

                <div class="flex gap-x-2">
                    <div class="flex-1">
                        <x-form.input-label for="guardian_first_name" :value="__('First Name')" />
                        <x-form.text-input id="guardian_first_name" class="block mt-1 w-full" type="text"
                            name="guardian_first_name" :value="old('guardian_first_name')" required autofocus autocomplete="on"
                            placeholder="Juan" />

                        <x-form.input-error :messages="$errors->get('guardian_first_name')" class="mt-2" />
                    </div>
                    <div class="flex-1">
                        <x-form.input-label for="guardian_middle_name" :value="__('Middle Name')" class="optional" />
                        <x-form.text-input id="guardian_middle_name" class="block mt-1 w-full" type="text"
                            name="guardian_middle_name" :value="old('guardian_middle_name')" autofocus autocomplete="on"
                            placeholder="Josephito" />

                        <x-form.input-error :messages="$errors->get('guardian_middle_name')" class="mt-2" />
                    </div>
                </div>

                <div class="flex gap-x-2">
                    <div class="flex-1">
                        <x-form.input-label for="guardian_surname" :value="__('Last Name')" />
                        <x-form.text-input id="guardian_surname" class="block mt-1 w-full" type="text"
                            name="guardian_surname" :value="old('guardian_surname')" required autofocus autocomplete="on"
                            placeholder="Dela Cruz" />

                        <x-form.input-error :messages="$errors->get('guardian_surname')" class="mt-2" />
                    </div>
                    <div class="flex-1">
                        <x-form.input-label for="guardian_suffix" :value="__('Suffix (Leave blank if none)')" />
                        <x-form.select.select-input name="guardian_suffix" id="guardian_suffix"
                            class="block mt-1 w-full">
                            <x-form.select.select-option :disabled="true" :selected="true" :option_name="__('Select a suffix')" />

                            @foreach (Suffix::cases() as $suf)
                                <x-form.select.select-option :value="$suf" :option_name="$suf" />
                            @endforeach
                        </x-form.select.select-input>

                        <x-form.input-error :messages="$errors->get('guardian_suffix')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-form.input-label for="guardian_phone_no" :value="__('Phone Number')" />
                    <x-form.text-input id="guardian_phone_no" class="block mt-1 w-full" type="text"
                        name="guardian_phone_no" :value="old('guardian_phone_no')" required autofocus autocomplete="on"
                        placeholder="09123456789" />

                    <x-form.input-error :messages="$errors->get('guardian_phone_no')" class="mt-2" />
                </div>

                <div>
                    <x-form.input-label for="guardian_email" :value="__('Email Address')" class="optional" />
                    <x-form.text-input id="guardian_email" class="block mt-1 w-full" type="email"
                        name="guardian_email" :value="old('guardian_email')" autofocus autocomplete="on"
                        placeholder="juandelacruz@example.com" />

                    <x-form.input-error :messages="$errors->get('guardian_email')" class="mt-2" />
                </div>
            </section>

            <div x-data="{ checked: false }" class="flex flex-col gap-y-4">
                <div class="flex items-center gap-x-2">
                    <x-form.input-label for="enroll_student" :value="__('Enroll this student to current academic year?')" />
                    <input @click="checked = !checked" type="checkbox" name="enroll_student" id="enroll_student"
                        class="p-2 accent-primary">
                </div>

                <div x-cloak x-show="checked">
                    <x-form.input-label for="grade_level" :value="__('Enroll the student to which grade level?')" />
                    <x-form.select.select-input name="grade_level" id="grade_level" class="block mt-1 w-full">
                        <x-form.select.select-option :disabled="true" :selected="true" :option_name="__('Select grade level')" />

                        <x-form.select.select-option :value="11" :option_name="__('Gr. 11')" />
                        <x-form.select.select-option :value="12" :option_name="__('Gr. 12')" />
                    </x-form.select.select-input>
                </div>
            </div>

            <div>
                <x-primary-button>Create</x-primary-button>
            </div>
        </form>
    </x-card>
</x-app.admin.main-container>
