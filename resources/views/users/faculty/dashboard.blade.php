<x-app.faculty.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('Hello, ') . Auth::user()->profile->first_name" />

        {{-- TODO: Render actual data --}}
        <div class="flex gap-x-5">
            <div class="flex-[2_2_0%] flex flex-col gap-y-4">
                <div class="flex flex-col gap-y-2">
                    <h2 class="font-bold text-lg">Overview</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 font-fs">
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
                                    <span class="text-2xl truncate font-semibold">2</span>
                                </div>
                            </div>
                        </x-card>
                        <x-card class="py-3 px-4 flex flex-row gap-x-4">
                            <div>
                                <div
                                    class="w-12 aspect-square border border-primary rounded-full inline-flex justify-center items-center text-xl text-primary">
                                    <i class="fa-solid fa-flag"></i>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <h2 class="font-semibold uppercase text-sm text-gray-500">Complaints Submitted</h2>

                                <div>
                                    <span class="text-2xl truncate font-semibold">4</span>
                                </div>
                            </div>
                        </x-card>
                    </div>
                </div>

                <div class="flex flex-col gap-y-2">
                    <h2 class="font-bold text-lg">Calendar</h2>
                    <x-card class="py-3 px-4">
                        <div id="calendar" class="overflow-auto z-0"></div>
                    </x-card>
                </div>

                {{-- <div class="flex flex-col gap-y-2">
                    <div class="flex justify-between items-center">
                        <h2 class="font-bold text-lg">Advisory Section (A.Y. {{ $year->getFullYear() }})</h2>

                        <a href="#" class="btn-link">View</a>
                    </div>

                    <x-card class="py-3 px-4 flex flex-col gap-y-2">
                        <h3 class="text-lg font-bold">GAS 11-A</h3>

                        <div class="font-fs grid grid-cols-1 md:grid-cols-2">
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
                                        <span class="text-2xl truncate font-semibold">35</span>
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
                                        <span class="text-2xl truncate font-semibold">7</span>
                                    </div>
                                </div>
                            </x-card>
                        </div>
                    </x-card>
                </div> --}}
            </div>

            <div class="flex-1 flex flex-col">
                <x-card class="px-4 py-8 flex flex-col gap-y-8">
                    <div class="flex flex-col gap-y-4">
                        <div class="flex flex-col gap-y-2">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-bold">Advisory (A.Y. {{ $year->getFullYear() }})</h3>
                                <a href="#" class="btn-link">See Info</a>
                            </div>

                            <h4 class="font-bold font-fs text-gray-500">GAS 11-A</h4>
                        </div>

                        <div class="font-fs grid grid-cols-1 md:grid-cols-2">
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
                                        <span class="text-2xl truncate font-semibold">35</span>
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
                                        <span class="text-2xl truncate font-semibold">7</span>
                                    </div>
                                </div>
                            </x-card>
                        </div>
                    </div>

                    <div class="flex flex-col gap-y-4">
                        <div class="flex justify-between items-center">
                            <h2 class="font-bold text-lg">Subjects</h2>

                            <a href="#" class="btn-link">See More</a>
                        </div>

                        <ul class="flex flex-col gap-y-2 text-sm">
                            <li class="flex justify-between items-center">
                                <div class="flex flex-col gap-y-1">
                                    <span class="font-semibold">Reading and Writing</span>
                                    <span class="text-xs text-gray-500">2 section(s)</span>
                                </div>

                                <div class="tooltip" data-tip="View">
                                    <a href="#" class="btn btn-outline btn-primary btn-circle"><i
                                            class="ri-arrow-right-up-line"> </i></a>
                                </div>
                            </li>

                            <li class="flex justify-between items-center">
                                <div class="flex flex-col gap-y-1">
                                    <span class="font-semibold">Entrepreneurship</span>
                                    <span class="text-xs text-gray-500">1 section(s)</span>
                                </div>

                                <div class="tooltip" data-tip="View">
                                    <a href="#" class="btn btn-outline btn-primary btn-circle"><i
                                            class="ri-arrow-right-up-line"> </i></a>
                                </div>
                            </li>
                        </ul>
                    </div>

                    {{-- <div class="flex flex-col gap-y-2">
                        <h2 class="font-bold text-lg">Calendar</h2>

                        <div class="">
                            <div id="calendar" class="overflow-auto z-0"></div>
                        </div>
                    </div> --}}
                </x-card>
            </div>
        </div>
    </main>

    @push('js')
        <script>
            const months = [
                'Jan.',
                'Feb.',
                'Mar.',
                'Apr.',
                'May',
                'Jun.',
                'Jul.',
                'Aug.',
                'Sep.',
                'Oct.',
                'Nov.',
                'Dec.'
            ];

            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    aspectRatio: 1,
                    contentHeight: 300,
                    headerToolbar: {
                        left: 'title',
                        center: '',
                        right: 'today prev,next',
                        // right: 'timeGridDay,dayGridWeek,dayGridMonth'
                    },
                    buttonText: {
                        today: 'Today',
                    },
                    initialView: 'dayGridMonth',
                    dayMaxEvents: true, // allow "more" link when too many events
                    nowIndicator: true,
                    eventColor: '#15803d',
                    eventDisplay: 'block',
                    // expandRows: true,
                    eventClick: function(info) {
                        info.jsEvent.preventDefault(); // don't let the browser navigate

                        if (info.event.url) {
                            // console.log(info.event.url);

                            container = document.getElementById('event-info-container');
                            eventTitle = document.getElementById('event-info-title');
                            eventStart = document.getElementById('event-info-start');
                            eventEnd = document.getElementById('event-info-end');

                            container.classList.remove('hidden')
                            container.classList.add('block');

                            eventTitle.textContent = info.event.title;
                            eventStart.textContent =
                                `${months[info.event.start.getMonth()]} ${info.event.start.getDate()}, ${info.event.start.getFullYear()}`;
                            eventEnd.textContent =
                                `${months[info.event.end.getMonth()]} ${info.event.end.getDate()}, ${info.event.end.getFullYear()}`;

                            // console.log('Before', eventLink.getAttribute('href'));
                            eventLink = document.getElementById('event-info-link');

                            // If the element exists, set href attribute
                            if (eventLink) {
                                eventLink.setAttribute("href", info.event.url);
                            }
                            // console.log('After', eventLink.getAttribute('href'));
                        }
                    },
                });
                calendar.render();
            });

            function closeEventInfo() {
                container = document.getElementById('event-info-container');

                container.classList.remove('block')
                container.classList.add('hidden');
            }
        </script>
    @endpush
</x-app.faculty.main-container>
