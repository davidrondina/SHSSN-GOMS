@php
    use Carbon\Carbon;
@endphp

<x-app.counselor.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('Appointments')">
            <x-slot name="controls">
                <div class="flex items-center gap-x-4">
                    <a href="{{ route('admin.subjects.create') }}"
                        class="btn btn-primary btn-sm inline-flex items-center font-semibold">
                        <i class="fa-solid fa-plus"></i>New Appointment
                    </a>
                </div>
            </x-slot>
        </x-app.page-header>

        <div class="flex gap-x-5">
            <div class="flex-[2_2_0%] bg-white px-4 py-8">
                <div id="calendar" class="overflow-auto z-0"></div>

                {{-- <div id="event-info-container"
                    class="z-50 fixed top-3 left-1/2 -translate-x-1/2  bg-white w-full sm:w-96 p-6 border border-gray-300 rounded-md shadow hidden">
                    <div class="mb-3 flex justify-between items-center">
                        <div></div>
                        <h3 id="event-info-title" class="font-semibold text-lg"></h3>
                        <button onclick="closeEventInfo()" type="button"
                            class="bg-gray-200 hover:bg-gray-300 w-8 h-8 p-2 text-gray-600 flex justify-center items-center hover:text-black rounded-full font-semibold"><i
                                class="ri-close-line font-normal"></i></button>
                    </div>
                    <div class="w-full mb-4 space-y-2">
                        <div class="grid grid-cols-2">
                            <div>
                                <p class="font-semibold">Start</p>
                            </div>
                            <div>
                                <i class="ri-time-line mr-2"></i>
                                <span id="event-info-start" class="text-gray-500"></span>
                            </div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div>
                                <p class="font-semibold">End</p>
                            </div>
                            <div>
                                <i class="ri-time-line mr-2"></i>
                                <span id="event-info-end" class="text-gray-500"></span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <a href="#" id="event-info-link"
                            class="bg-white hover:bg-green-200 border border-gray-300 transition ease-in-out duration-150 focus:ring-2 focus:ring-accent focus:ring-offset-2 uppercase font-bold text-sm px-5 py-2.5 rounded-lg shadow-sm">Edit</a>
                    </div>
                </div> --}}
            </div>

            <div class="flex-1 flex flex-col">
                <x-card class="px-4 py-8 flex flex-col gap-y-8">
                    <div class="flex flex-col gap-y-4">
                        <h2 class="font-bold text-lg">Upcoming appointments</h2>

                        <ul class="max-h-[300px] flex flex-col gap-y-2 text-sm overflow-y-auto">
                            @forelse ($upcoming_apps as $app)
                                @php
                                    $respondent = $app->complaint->respondent;
                                @endphp

                                <li class="flex justify-between items-center">
                                    <div class="flex flex-col gap-y-1">
                                        <span class="font-semibold">Respondent: {{ $respondent->getFullName() }}</span>
                                        <span
                                            class="text-xs text-gray-500">{{ Carbon::parse($app->start_date)->format('l, M. d') . ', ' . Carbon::parse($app->start_date)->format('g:i A') . ' - ' . Carbon::parse($app->end_date)->format('g:i A') }}</span>
                                    </div>

                                    <div class="tooltip" data-tip="View">
                                        <a href="{{ route('counselor.appointments.show', $app->id) }}"
                                            class="btn btn-outline btn-primary btn-circle"><i
                                                class="ri-arrow-right-up-line"> </i></a>
                                    </div>
                                </li>
                            @empty
                                <li class="text-center text-gray-500">There are no upcoming appoitments.</li>
                            @endforelse

                            {{-- <li class="flex justify-between items-center">
                                <div class="flex flex-col gap-y-1">
                                    <span class="font-semibold">Respondent: David Rondina</span>
                                    <span class="text-xs text-gray-500">5:00PM - 6:00PM</span>
                                </div>

                                <div class="tooltip" data-tip="View">
                                    <a href="#" class="btn btn-outline btn-primary btn-circle"><i
                                            class="ri-arrow-right-up-line"> </i></a>
                                </div>
                            </li> --}}
                        </ul>
                    </div>
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
                    headerToolbar: {
                        left: 'today prev,next',
                        center: 'title',
                        right: 'timeGridDay,dayGridWeek,dayGridMonth'
                    },
                    buttonText: {
                        today: 'Today',
                        month: 'Month',
                        week: 'Week',
                        day: 'Day',
                    },
                    initialView: 'dayGridMonth',
                    dayMaxEvents: true, // allow "more" link when too many events
                    dayMaxEventRows: 4,
                    navLinks: true,
                    nowIndicator: true,
                    events: @json($appointments),
                    eventColor: '#F0C13E',
                    eventTextColor: '#333333',
                    height: 700,
                    expandRows: true,
                    // eventClick: function(info) {
                    //     info.jsEvent.preventDefault(); // don't let the browser navigate

                    //     if (info.event.url) {
                    //         // console.log(info.event.url);

                    //         container = document.getElementById('event-info-container');
                    //         eventTitle = document.getElementById('event-info-title');
                    //         eventStart = document.getElementById('event-info-start');
                    //         eventEnd = document.getElementById('event-info-end');

                    //         container.classList.remove('hidden')
                    //         container.classList.add('block');

                    //         eventTitle.textContent = info.event.title;
                    //         eventStart.textContent =
                    //             `${months[info.event.start.getMonth()]} ${info.event.start.getDate()}, ${info.event.start.getFullYear()}`;
                    //         eventEnd.textContent =
                    //             `${months[info.event.end.getMonth()]} ${info.event.end.getDate()}, ${info.event.end.getFullYear()}`;

                    //         // console.log('Before', eventLink.getAttribute('href'));
                    //         eventLink = document.getElementById('event-info-link');

                    //         // If the element exists, set href attribute
                    //         if (eventLink) {
                    //             eventLink.setAttribute("href", info.event.url);
                    //         }
                    //         // console.log('After', eventLink.getAttribute('href'));
                    //     }
                    // },
                    // eventContent: function(arg) {
                    //     const link = document.createElement('a');

                    //     link.setAttribute('href', arg.event.url);
                    //     link.textContent = `${arg.event.start} - ${arg.event.title}`;

                    //     return {
                    //         domNodes: [link]
                    //     };
                    // },
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
</x-app.counselor.main-container>
