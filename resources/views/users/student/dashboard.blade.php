<x-app.student.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('Hello, ') . Auth::user()->profile->first_name" />

        <div class="flex gap-x-5">
            <div class="md:max-h-screen md:overflow-y-auto flex-[2_2_0%] flex flex-col gap-y-4">
                <div class="flex flex-col gap-y-2">
                    <h2 class="z-10 bg-base-100 md:sticky md:top-0 md:left-0 font-bold text-lg">Overview</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 font-fs">
                        <x-card class="py-3 px-4 flex flex-row gap-x-4">
                            <div>
                                <div
                                    class="w-12 aspect-square border border-primary rounded-full inline-flex justify-center items-center text-xl text-primary">
                                    <i class="fa-solid fa-flag"></i>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <h2 class="font-semibold uppercase text-sm text-gray-500">Total Offenses</h2>

                                <div>
                                    <span class="text-2xl truncate font-semibold">0</span>
                                </div>
                            </div>
                        </x-card>

                        <x-card class="py-3 px-4 flex flex-row gap-x-4">
                            <div>
                                <div
                                    class="w-12 aspect-square border border-success rounded-full inline-flex justify-center items-center text-xl text-success">
                                    <i class="fa-solid fa-file"></i>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <h2 class="font-semibold uppercase text-sm text-gray-500">Total Acquisitions</h2>

                                <div>
                                    <span class="text-2xl truncate font-semibold">0</span>
                                </div>
                            </div>
                        </x-card>
                    </div>
                </div>

                <div class="flex flex-col gap-y-2">
                    <h2 class="z-10 bg-base-100 md:sticky md:top-0 md:left-0 font-bold text-lg">A.Y. 2024 - 2025</h2>
                    <x-card class="py-3 px-4 flex flex-col gap-y-8">
                        <div class="flex flex-col gap-y-4">
                            <h3 class="font-bold">Your Section: GAS 11-A</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 font-fs">
                                <x-card class="py-3 px-4 flex flex-row gap-x-4">
                                    <div>
                                        <div
                                            class="w-12 aspect-square border border-accent rounded-full inline-flex justify-center items-center text-xl text-accent">
                                            <i class="fa-solid fa-user-graduate"></i>
                                        </div>
                                    </div>
                                    <div class="flex flex-col">
                                        <h2 class="font-semibold uppercase text-sm text-gray-500">Students</h2>

                                        <div>
                                            <span class="text-2xl truncate font-semibold">0</span>
                                        </div>
                                    </div>
                                </x-card>

                                <x-card class="py-3 px-4 flex flex-row gap-x-4">
                                    <div>
                                        <div
                                            class="w-12 aspect-square border border-red-700 rounded-full inline-flex justify-center items-center text-xl text-red-700">
                                            <i class="fa-solid fa-book-open"></i>
                                        </div>
                                    </div>
                                    <div class="flex flex-col">
                                        <h2 class="font-semibold uppercase text-sm text-gray-500">Subjects</h2>

                                        <div>
                                            <span class="text-2xl truncate font-semibold">0</span>
                                        </div>
                                    </div>
                                </x-card>
                            </div>
                        </div>

                        <x-table.wrapper>
                            <x-table.head>
                                <tr>
                                    <x-table.header-cell :scope="__('col')">Subject Name</x-table.header-cell>
                                    <x-table.header-cell :scope="__('col')">Faculty</x-table.header-cell>
                                </tr>
                            </x-table.head>
                            <x-table.body>
                                {{-- @forelse ($subjects as $sub) --}}
                                @for ($i = 0; $i < 8; $i++)
                                    <tr class="bg-white border-b">
                                        <x-table.header-cell :scope="__('row')">Reading and Writing</x-table.header-cell>
                                        <x-table.regular-cell>Rondina, David</x-table.regular-cell>
                                    </tr>
                                @endfor
                                {{-- @endforelse --}}
                            </x-table.body>
                        </x-table.wrapper>
                    </x-card>
                </div>
            </div>

            <div class="flex-1 flex flex-col">
                <x-card class="px-4 py-8 flex flex-col gap-y-8">
                    <div class="flex flex-col gap-y-4">
                        <div class="flex justify-between items-center">
                            <h2 class="font-bold text-lg">Upcoming appointments</h2>

                            <a href="{{ route('counselor.appointments.index') }}" class="btn-link">See More</a>
                        </div>

                        <ul class="max-h-[300px] flex flex-col gap-y-2 text-sm overflow-y-auto">
                            {{-- @forelse ($weekly_apps as $app) --}}
                            {{-- @php
                                    $respondent = $app->complaint->respondent;
                                @endphp --}}

                            @for ($i = 0; $i < 6; $i++)
                                <li class="flex justify-between items-center">
                                    <div class="flex flex-col gap-y-1">
                                        <span class="font-semibold">Monday, April 29, 2023</span>
                                        <span class="text-xs text-gray-500">5:00 PM - 6:00
                                            PM{{-- {{ Carbon::parse($app->start_date)->format('l, M. d') . ', ' . Carbon::parse($app->start_date)->format('g:i A') . ' - ' . Carbon::parse($app->end_date)->format('g:i A') }} --}}</span>
                                    </div>

                                    <div class="tooltip" data-tip="View">
                                        <a href="#" class="btn btn-outline btn-primary btn-circle"><i
                                                class="ri-arrow-right-up-line"> </i></a>
                                    </div>
                                </li>
                            @endfor
                            {{-- @empty --}}
                            <li class="text-center text-gray-500">There are no upcoming appointments.</li>
                            {{-- @endforelse --}}
                        </ul>
                    </div>
                </x-card>
            </div>
        </div>
    </main>
</x-app.student.main-container>
