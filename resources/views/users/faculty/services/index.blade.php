@php
    use App\Enums\DocumentType;
    use App\Models\DocumentAcquisition;

    $acquisitions = DocumentAcquisition::where('user_id', Auth::user()->id);

    $gm_acquisitions = $acquisitions->where('name', DocumentType::GM->value);
@endphp

<x-app.faculty.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('Services')" />

        <div class="grid grid-cols-2 gap-5">
            <x-service-card :href="route('faculty.services.create') . __('?type=pn')">
                <div class="flex flex-col gap-y-1">
                    <span class="group-hover:underline">Promissory Form</span>
                </div>
            </x-service-card>
        </div>
    </main>
</x-app.faculty.main-container>
