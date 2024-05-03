<x-app.student.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('Services')" />

        <div class="grid grid-cols-2 gap-5">
            <x-service-card :href="route('student.services.create') . __('?type=gm')">Good Moral Certificate</x-service-card>
            <x-service-card :href="route('student.services.create') . __('?type=pn')">Promissory Note</x-service-card>
            <x-service-card :href="route('student.services.create') . __('?type=fg')">List of Failing Grades</x-service-card>
            <x-service-card :href="route('student.services.create') . __('?type=df')">Dropping Form</x-service-card>
        </div>
    </main>
</x-app.student.main-container>
