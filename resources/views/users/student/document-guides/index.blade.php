<x-app.student.main-container>
    <x-card class="px-6 py-5 flex flex-col gap-y-5">
        <div class="card-title">
            <h1 class="font-bold text-2xl">{{ $guide->name . ' - Instructions' }}</h1>
        </div>

        <div class="prose prose-base">
            {!! $guide->description !!}
        </div>

        @empty(Request::get('feedback'))
            <x-form.feedback-form :fields="['type' => $type]" />
        @endempty
    </x-card>
</x-app.student.main-container>
