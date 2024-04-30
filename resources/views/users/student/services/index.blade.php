<x-app.student.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('Services')" />

        <div class="grid grid-cols-2 gap-5">
            <x-service-card>Good Moral Certificate</x-service-card>
            <x-service-card>Promissory Note</x-service-card>
            <x-service-card>List of Failing Grades</x-service-card>
            <x-service-card>Dropping Form</x-service-card>
        </div>
    </main>
</x-app.student.main-container>
