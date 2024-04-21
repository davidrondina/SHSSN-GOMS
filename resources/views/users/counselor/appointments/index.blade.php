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

        <div class="bg-white px-4 py-8">
            <div id="calendar" class="overflow-auto z-0"></div>
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
                    nowIndicator: true,
                    events: @json($appointments),
                    eventColor: '#15803d',
                    eventDisplay: 'block',
                    contentHeight: 'auto',
                    expandRows: true,
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
</x-app.counselor.main-container>
