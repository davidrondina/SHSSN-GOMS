@php
    use Carbon\Carbon;
@endphp

<x-app.counselor.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('Hello, ') . Auth::user()->profile->first_name" />

        <div class="flex gap-x-5">
            <div class="flex-[2_2_0%] flex flex-col gap-y-4">
                <div class="flex flex-col gap-y-2">
                    <h2 class="font-bold text-lg">Overview</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 font-fs">
                        <x-card class="py-3 px-4 flex flex-row gap-x-4">
                            <div>
                                <div
                                    class="w-12 aspect-square border border-green-700 rounded-full inline-flex justify-center items-center text-xl text-green-700">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <h2 class="font-semibold uppercase text-sm text-gray-500">Total Cases</h2>

                                <div>
                                    <span class="text-2xl truncate font-semibold">{{ $cases_count }}</span>
                                </div>
                            </div>
                        </x-card>
                        <x-card class="py-3 px-4 flex flex-row gap-x-4">
                            <div>
                                <div
                                    class="w-12 aspect-square border border-primary rounded-full inline-flex justify-center items-center text-xl text-primary">
                                    <i class="fa-solid fa-calendar"></i>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <h2 class="font-semibold uppercase text-sm text-gray-500">Upcoming Appointments</h2>

                                <div>
                                    <span class="text-2xl truncate font-semibold">{{ $upcoming_apps->count() }}</span>
                                </div>
                            </div>
                        </x-card>
                    </div>
                </div>

                <div class="flex gap-x-2">
                    {{-- <h2 class="font-bold text-lg">This Week's Appointments</h2> --}}

                    <div class="px-4 py-8 bg-white flex-[2_2_0%] flex flex-col gap-y-2">
                        <h2 class="font-bold text-lg">Cases Data</h2>

                        <div x-data="casesChart()" x-init="render()" x-cloak
                            x-show="document.getElementById('casesChartCanvas') !== null"
                            class="w-full py-2 flex items-center">
                            <div id="casesChartCanvas" class="w-full">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-1 flex flex-col">
                <x-card class="px-4 py-8 flex flex-col gap-y-8">
                    <div class="flex flex-col gap-y-2">
                        <h2 class="font-bold text-lg">Calendar</h2>

                        <div class="">
                            <div id="calendar" class="overflow-auto z-0"></div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-y-4">
                        <div class="flex justify-between items-center">
                            <h2 class="font-bold text-lg">This week's appointments</h2>

                            <a href="{{ route('counselor.appointments.index') }}" class="btn-link">See More</a>
                        </div>

                        <ul class="max-h-[300px] flex flex-col gap-y-2 text-sm overflow-y-auto">
                            @forelse ($weekly_apps as $app)
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
                    aspectRatio: 0.40,
                    contentHeight: 300,
                    headerToolbar: {
                        left: 'title',
                        center: '',
                        right: '',
                        // right: 'timeGridDay,dayGridWeek,dayGridMonth'
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

        <script>
            const casesChart = () => {
                return {
                    options: {
                        series: [{
                            name: "Cases submitted",
                            data: {{ json_encode($cases) }}
                        }],
                        chart: {
                            height: 350,
                            type: 'line',
                            zoom: {
                                enabled: false
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'straight'
                        },
                        grid: {
                            row: {
                                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                opacity: 0.5
                            },
                        },
                        xaxis: {
                            categories: @php echo json_encode($month_names) @endphp,
                        }
                    },

                    render() {
                        return new ApexCharts(document.getElementById('casesChartCanvas'), this.options)
                            .render();
                    }
                }
            }
        </script>
    @endpush
</x-app.counselor.main-container>
