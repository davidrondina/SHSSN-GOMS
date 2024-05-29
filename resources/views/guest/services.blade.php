<x-guest-layout>
    <x-container class="py-9 flex flex-col h-screen">
        <x-app.page-header :show_title="true" :title="__('Services')" />

        <div class="w-full flex flex-wrap gap-x-6">
            <div class="flex-1 flex flex-col gap-y-3 mb-8">
                <h2 class="text-lg font-bold">For Students</h2>
                <div>
                    <x-service-card :href="route('student.services.index')">
                        <div class="flex flex-col gap-y-1">
                            <span class="group-hover:underline">Certificate of Good Moral Character</span>
                        </div>
                    </x-service-card>
                </div>
            </div>

            <div class="flex-1 flex flex-col gap-y-3">
                <h2 class="text-lg font-bold">For Faculty</h2>
                <div>
                    <x-service-card :href="route('faculty.services.index')">
                        <div class="flex flex-col gap-y-1">
                            <span class="group-hover:underline">Promissory Form</span>
                        </div>
                    </x-service-card>
                </div>
            </div>
        </div>
    </x-container>
</x-guest-layout>
