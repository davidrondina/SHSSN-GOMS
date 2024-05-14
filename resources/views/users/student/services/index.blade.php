@php
    use App\Enums\DocumentType;
    use App\Models\DocumentAcquisition;

    $acquisitions = DocumentAcquisition::where('user_id', Auth::user()->id);

    $gm_acquisitions = $acquisitions->where('name', DocumentType::GM->value);
@endphp

<x-app.student.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('Services')" />

        <div class="grid grid-cols-2 gap-5">
            <x-service-card :href="route('student.services.create') . __('?type=gm')">
                <div class="flex flex-col gap-y-1">
                    <span class="group-hover:underline">Good Moral Certificate</span>
                    <span class="text-sm font-normal">No. of acquisitions: ({{ $gm_acquisitions->count() }}/3)</span>
                </div>
            </x-service-card>
            {{-- <x-service-card :href="route('student.services.create') . __('?type=pn')">Promissory Note</x-service-card>
            <x-service-card :href="route('student.services.create') . __('?type=fg')">List of Failing Grades</x-service-card>
            <x-service-card :href="route('student.services.create') . __('?type=df')">Dropping Form</x-service-card> --}}
        </div>
    </main>
</x-app.student.main-container>
