@php
    use App\Models\SectionSubject;
@endphp

<x-app.faculty.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('My Classes (A.Y. ' . $year->getFullYear() . ')')">
            <x-slot name="controls">
                <div x-data="{ filterOpened: false }" class="flex gap-x-4">
                    <button x-ref="filterBtn" @click="filterOpened = !filterOpened" type="button"
                        class="btn btn-sm btn-accent">
                        <i class="fa-solid" :class="filterOpened ? 'fa-times' : 'fa-filter'"></i>
                        <span x-text="filterOpened ? 'Close' : 'Filter'"></span>
                    </button>

                    <div x-cloak @click.outside="filterOpened = false" x-show="filterOpened"
                        x-anchor.bottom-end="$refs.filterBtn"
                        class="z-20 bg-white p-4 w-[600px] flex flex-col gap-y-4 border border-gray-300 shadow-md">
                        <x-form.search-form :form_action="__('#')" :placeholder="__('Search section name')" class="w-full" />

                        <form action="" method="get" class="flex gap-x-2">
                            <x-form.select.select-input>
                                <x-form.select.select-option :disabled="true" :selected="true" :option_name="__('Filter by subject')" />
                                <x-form.select.select-option :value="11" :option_name="__('Gr. 11')" />
                                <x-form.select.select-option :value="12" :option_name="__('Gr. 12')" />
                            </x-form.select.select-input>

                            <x-form.select.select-input>
                                <x-form.select.select-option :disabled="true" :selected="true" :option_name="__('Filter by grade level')" />
                                <x-form.select.select-option :value="11" :option_name="__('Gr. 11')" />
                                <x-form.select.select-option :value="12" :option_name="__('Gr. 12')" />
                            </x-form.select.select-input>

                            <x-primary-button>Go</x-primary-button>
                        </form>
                    </div>
                </div>
            </x-slot>
        </x-app.page-header>

        <div class="flex gap-x-5">
            <div class="flex-[2_2_0%] flex flex-col gap-y-4">
                @unless ($fac_classes)
                    <p class="text-center text-gray-500">You have no classes.</p>
                @else
                    <div class="md:max-h-screen md:overflow-y-auto grid md:grid-cols-2 gap-6">
                        @foreach ($fac_classes as $class)
                            @php
                                $section = $class->section;
                                $subject = $class->subject;
                                $adviser = $section->adviser;
                            @endphp

                            <div
                                class="hover:scale-95 transition ease-in-out duration-300 pointer-events-none h-[1000px] max-h-60 flex flex-col">
                                <div class="flex-[2_2_0%] bg-primary p-4 text-base-100 flex flex-col justify-between">
                                    <a href="{{ route('faculty.classes.show', $section->id) }}"
                                        class="pointer-events-auto group flex flex-col gap-y-1">
                                        <h2 class="font-bold text-xl group-hover:underline">
                                            {{ $section->name . ' (Grade ' . $section->grade_level . ')' }}</h2>
                                        <span class="text-sm">{{ $subject->name }}</span>
                                    </a>
                                    <span class="text-sm">{{ $section->students->count() }} student(s)</span>
                                </div>
                                <div class="flex-1 bg-white p-4">
                                    <span class="text-sm font-semibold">Adviser:
                                        {{ $adviser->user->profile->getFullName() }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endunless
            </div>

            <div class="flex-1 flex flex-col">
                <x-card class="px-4 py-8 flex flex-col gap-y-8">
                    <div class="flex flex-col gap-y-4">
                        <h2 class="font-bold text-lg">Subjects</h2>

                        <ul class="max-h-[300px] overflow-y-auto flex flex-col gap-y-2 text-sm">
                            @forelse ($fac_subjects as $sub)
                                @php
                                    $sections = SectionSubject::where([
                                        ['faculty_id', $faculty->id],
                                        ['subject_id', $sub->id],
                                    ])->whereHas('section', function ($query) use ($year) {
                                        $query->where('academic_year_id', $year->id);
                                    });
                                @endphp
                                <li class="flex justify-between items-center">
                                    <div class="flex flex-col gap-y-1">
                                        <span class="font-semibold">{{ $sub->name }}</span>
                                        <span class="text-xs text-gray-500">{{ $sections->count() }} section(s)</span>
                                    </div>
                                </li>
                            @empty
                                <li class="text-center text-gray-500">You have no subjects.</li>
                            @endforelse
                        </ul>
                </x-card>
            </div>
        </div>
    </main>
</x-app.faculty.main-container>
