<x-app-layout>
    <div class="flex">
        {{ $sidebar }}

        <div class="relative w-full h-screen flex flex-col overflow-y-hidden">
            <x-app.header />

            <div class="w-full h-screen overflow-x-hidden flex flex-col">
                {{ $slot }}
            </div>
        </div>
    </div>
</x-app-layout>
