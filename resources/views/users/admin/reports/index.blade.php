<x-app.admin.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('Generate Reports')" />

        <div class="grid grid-cols-2 gap-5">
            <x-service-card :href="route('admin.reports.create') . __('?report=enrolled-students')">
                <div class="flex flex-col gap-y-1">
                    <span class="group-hover:underline">Enrolled Students Summary</span>
                </div>
            </x-service-card>
            <x-service-card :href="route('admin.reports.create') . __('?report=faculties')">
                <div class="flex flex-col gap-y-1">
                    <span class="group-hover:underline">Faculties Summary</span>
                </div>
            </x-service-card>
        </div>
    </main>
</x-app.admin.main-container>
