<x-guest-layout>
    <x-container class="py-16 flex justify-center items-center">
        <x-card class="w-1/2 flex flex-col justify-center gap-y-5 px-6 py-5">
            <div class="flex flex-col gap-y-2">
                <h1 class="font-bold text-2xl">
                    Register Account
                </h1>
            </div>

            <x-auth.faculty-register-form :departments="$departments" />
        </x-card>
    </x-container>
</x-guest-layout>
