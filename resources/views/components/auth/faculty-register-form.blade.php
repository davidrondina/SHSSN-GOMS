@php
    use App\Enums\Sex;
    use App\Enums\Suffix;
@endphp

@props(['departments'])

<form action="{{ route('register') }}" method="post" class="flex flex-col gap-y-7">
    @csrf

    <input type="hidden" name="link_token" value="{{ Request::get('token') }}">

    <section class="flex flex-col gap-y-4">
        <div class="flex flex-col gap-y-2">
            <h2 class="text-xl font-bold">Account Information</h2>
            <p class="text-gray-500 text-sm">Provide email address and password of your account.</p>
        </div>

        <div>
            <x-form.input-label for="email" :value="__('Email address')" />

            <x-form.text-input id="email" class="block mt-1 w-full" type="email" name="email" required
                autocomplete="current-password" placeholder="juandc@gmail.com" />

            <x-form.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-form.input-label for="password" :value="__('Password')" />

            <x-form.text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" placeholder="Enter your account password" />

            <x-form.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-form.input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-form.text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="current-password"
                placeholder="Re-enter your account password" />

            <x-form.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div>
            <span class="text-sm">Password must be at least 8 characters.</span>
        </div>
    </section>

    <section class="flex flex-col gap-y-4">
        <div class="flex flex-col gap-y-2">
            <h2 class="text-xl font-bold">Personal Information</h2>
            <p class="text-gray-500 text-sm">Provide your personal information.</p>
        </div>

        <div class="flex gap-x-2">
            <div class="flex-1">
                <x-form.input-label for="first_name" :value="__('First Name')" />
                <x-form.text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                    :value="old('first_name')" required autofocus autocomplete="on" placeholder="Juan" />

                <x-form.input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>
            <div class="flex-1">
                <x-form.input-label for="middle_name" :value="__('Middle Name')" class="optional" />
                <x-form.text-input id="middle_name" class="block mt-1 w-full" type="text" name="middle_name"
                    :value="old('middle_name')" autofocus autocomplete="on" placeholder="Josephito" />

                <x-form.input-error :messages="$errors->get('middle_name')" class="mt-2" />
            </div>
        </div>

        <div class="flex gap-x-2">
            <div class="flex-1">
                <x-form.input-label for="surname" :value="__('Surname')" />
                <x-form.text-input id="surname" class="block mt-1 w-full" type="text" name="surname"
                    :value="old('surname')" required autofocus autocomplete="on" placeholder="Dela Cruz" />

                <x-form.input-error :messages="$errors->get('surname')" class="mt-2" />
            </div>
            <div class="flex-1">
                <x-form.input-label for="suffix" :value="__('Suffix (Leave blank if none)')" />
                <x-form.select.select-input name="suffix" id="student_suffix" class="block mt-1 w-full">
                    <x-form.select.select-option :disabled="true" :selected="true" :option_name="__('Select a suffix')" />

                    @foreach (Suffix::cases() as $suf)
                        <x-form.select.select-option :value="$suf" :option_name="$suf" />
                    @endforeach
                </x-form.select.select-input>

                <x-form.input-error :messages="$errors->get('suffix')" class="mt-2" />
            </div>
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

        <div>
            <x-form.input-label for="department" :value="__('Which faculty department do you belong to?')" />
            <x-form.select.select-input name="department_id" id="department" class="block mt-1 w-full">
                <x-form.select.select-option :disabled="true" :selected="true" :option_name="__('Select a department')" />

                @foreach ($departments as $dept)
                    <x-form.select.select-option :value="$dept->id" :option_name="$dept->name" />
                @endforeach
            </x-form.select.select-input>

            <x-form.input-error :messages="$errors->get('department')" class="mt-2" />
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
                    placeholder="Blk. 1, Lot 2, Garnet St., Brgy. Molino 3, Bacoor, Cavite" />

                <x-form.input-error :messages="$errors->get('address')" class="mt-2" />
            </div>
        </div>

        <div>
            <x-form.input-label for="phone_no" :value="__('Mobile Number')" />
            <x-form.text-input id="phone_no" class="block mt-1 w-full" type="text" name="phone_no"
                :value="old('phone_no')" autofocus autocomplete="one" placeholder="09123456789" required />

            <x-form.input-error :messages="$errors->get('phone_no')" class="mt-2" />
        </div>
    </section>

    <div class="flex justify-end items-center gap-x-7">
        <x-primary-button>
            {{ __('Register') }}
        </x-primary-button>
    </div>
</form>
