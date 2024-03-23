<form action="{{ route('login') }}" method="POST">
    @csrf

    <div>
        <x-form.input-label for="email" :value="__('Email')" />
        <x-form.text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
            autofocus autocomplete="username" placeholder="johndoe@gmail.com" />

        <x-form.input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div class="my-4">
        <x-form.input-label for="password" :value="__('Password')" />

        <x-form.text-input id="password" class="block mt-1 w-full" type="password" name="password" required
            autocomplete="current-password" placeholder="Enter your account password" />

        <x-form.input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div class="flex justify-end items-center gap-x-7">
        <a href="{{ route('register') }}" class="link link-secondary">Create account</a>
        <x-primary-button>
            {{ __('Log In') }}
        </x-primary-button>
    </div>
</form>
