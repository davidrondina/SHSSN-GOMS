<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/venobox/2.0.4/venobox.css"
        integrity="sha512-FklhNXzHcdzrbf6AqtmZo3hOse+bIr/ofmEpzZmNWftOTsj8qWasNgJN6Y8d71grmcZZZa1bbHbXFbTTPCa3pA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Quill text editor -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0/dist/quill.snow.css" rel="stylesheet" />

    <!-- ValidatorJS -->
    <script src="https://cdn.jsdelivr.net/npm/validatorjs@3.22.1/dist/validator.min.js"></script>

    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!--- jQuery -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')
    </script>

    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- FulLCalendar -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-calibri {
            font-family: Calibri, sans-serif;
        }
    </style>
</head>

<body class="font-is bg-base-100 text-neutral antialiased">
    <main x-ref="content" x-data="reportGenerator" class="w-3/5 my-8 mx-auto">
        <div x-ref="pageHeader">
            <x-app.page-header :show_title="true" :title="__('Generate Report')" :show_back_btn="true" :back_btn_url="route('admin.reports.index')">
                <x-slot name="controls">
                    <button @click="print()" class="btn btn-sm btn-accent"><i
                            class="fa-solid fa-print"></i>Print</button>
                </x-slot>
            </x-app.page-header>
        </div>

        <div x-ref="reportCanvas" class="bg-white py-4 px-5">
            <div style="margin: 0 auto;">
                <div style="text-align: center;"><img
                        style="display: inline-block; margin-right: 0.5rem; width: 4rem; height: 4rem;"
                        src="{{ asset('images/deped-logo-2.png') }}" alt=""></div>
                <p style="font-size: 9pt; text-align: center;">
                    Republic of the Philippines<br>
                    Department of Education<br>
                    <span style="font-weight: 700;">Region IV-A (CALABARZON)</span><br>
                    CITY SCHOOLS DIVISION OF BACOOR<br>
                    <span style="font-weight: 700;">SHS IN SAN NICOLAS III, BACOOR CITY</span><br>
                    <span>San Nicolas III, Bacoor City, Cavite<br>
                        Tel No. (046) 236 3371 / Cell No. 09-17-1264983</span>
                </p>
            </div>

            @switch($report)
                @case('dashboard')
                    <div class="mt-8 flex flex-col gap-y-4 text-[12pt]">
                        <div class="flex flex-col gap-y-2">
                            <h2 class="font-bold text-lg">Overview</h2>
                            <div class="grid grid-cols-4 gap-3 font-fs">
                                <x-card class="py-3 px-4 flex flex-row gap-x-4">
                                    <div>
                                        <div
                                            class="w-12 aspect-square border border-accent rounded-full inline-flex justify-center items-center text-xl text-accent">
                                            <i class="fa-solid fa-user-graduate"></i>
                                        </div>
                                    </div>
                                    <div class="flex flex-col">
                                        <h2 class="font-semibold uppercase text-sm text-gray-500">Total Students</h2>

                                        <div>
                                            <span class="text-2xl truncate font-semibold">{{ $students_count }}</span>
                                        </div>
                                    </div>
                                </x-card>
                                <x-card class="py-3 px-4 flex flex-row gap-x-4">
                                    <div>
                                        <div
                                            class="w-12 aspect-square border border-primary rounded-full inline-flex justify-center items-center text-xl text-primary">
                                            <i class="fa-solid fa-chalkboard-user"></i>
                                        </div>
                                    </div>
                                    <div class="flex flex-col">
                                        <h2 class="font-semibold uppercase text-sm text-gray-500">Total Faculties</h2>

                                        <div>
                                            <span class="text-2xl truncate font-semibold">{{ $faculties_count }}</span>
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
                                        <h2 class="font-semibold uppercase text-sm text-gray-500">Total Subjects</h2>

                                        <div>
                                            <span class="text-2xl truncate font-semibold">{{ $subjects_count }}</span>
                                        </div>
                                    </div>
                                </x-card>
                                <x-card class="py-3 px-4 flex flex-row gap-x-4">
                                    <div>
                                        <div
                                            class="w-12 aspect-square border border-green-700 rounded-full inline-flex justify-center items-center text-xl text-green-700">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="flex flex-col">
                                        <h2 class="font-semibold uppercase text-sm text-gray-500">Total Users</h2>

                                        <div>
                                            <span class="text-2xl truncate font-semibold">{{ $users_count }}</span>
                                        </div>
                                    </div>
                                </x-card>
                            </div>
                        </div>

                        <div class="flex flex-col gap-y-2">
                            <h2 class="font-bold text-lg">A.Y. {{ $year->getFullYear() }}</h2>

                            <div class="grid grid-cols-2 gap-3 font-fs">
                                <x-card class="py-3 px-4 flex flex-row gap-x-4">
                                    <div>
                                        <div
                                            class="w-12 aspect-square border border-accent rounded-full inline-flex justify-center items-center text-xl text-accent">
                                            <i class="fa-solid fa-user-graduate"></i>
                                        </div>
                                    </div>
                                    <div class="flex flex-col">
                                        <h2 class="font-semibold uppercase text-sm text-gray-500">Enrolled Students</h2>

                                        <div>
                                            <span class="text-2xl truncate font-semibold">{{ $enrolled_students_count }}</span>
                                        </div>
                                    </div>
                                </x-card>
                                <x-card class="py-3 px-4 flex flex-row gap-x-4">
                                    <div>
                                        <div
                                            class="w-12 aspect-square border border-orange-700 rounded-full inline-flex justify-center items-center text-xl text-orange-700">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                    </div>
                                    <div class="flex flex-col">
                                        <h2 class="font-semibold uppercase text-sm text-gray-500">Total Sections</h2>

                                        <div>
                                            <span class="text-2xl truncate font-semibold">{{ $sections_count }}</span>
                                        </div>
                                    </div>
                                </x-card>
                            </div>
                        </div>

                        <div class="px-4 py-8 bg-neutral-50 max-w-[100%] w-[1000px]">
                            <div x-data="acquisitionsChart()" x-init="render()" x-cloak
                                x-show="document.getElementById('acquisitionsChartCanvas') !== null"
                                class="h-full py-2 flex items-center">
                                <div id="acquisitionsChartCanvas" class="w-full">

                                </div>
                            </div>
                        </div>
                    </div>
                @break

                @case('enrolled-students')
                    <div class="mt-8 flex flex-col gap-y-6 text-[12pt]">
                        <h2 class="font-bold">Total students enrolled</h2>

                        <div class="font-bold flex gap-x-16">
                            <div><span>GRADE 11:</span> <span>{{ $students_by_grade_level['11'] }}</span></div>
                            <div><span>GRADE 12:</span> <span>{{ $students_by_grade_level['12'] }}</span></div>
                        </div>

                        <div class="aspect-square mx-auto">
                            <div x-data="studentsByStrandChart()" x-init="render()" x-cloak
                                x-show="document.getElementById('studentsByStrandChartCanvas') !== null"
                                class="h-full py-2 flex items-center">
                                <div id="studentsByStrandChartCanvas" class="w-full">

                                </div>
                            </div>
                        </div>

                        <div class="font-bold flex flex-wrap gap-x-16 gap-y-4">
                            @foreach ($students_by_strand as $stu)
                                <div><span>{{ $stu['name'] }}:</span> <span>{{ $stu['count'] }}</span></div>
                            @endforeach
                        </div>

                        {{-- <h2 class="font-bold">List of enrolled students</h2>

                        <x-table.wrapper>
                            <x-table.head>
                                <tr>
                                    <x-table.header-cell class="py-1" :scope="__('col')">LRN</x-table.header-cell>
                                    <x-table.header-cell class="py-1" :scope="__('col')">Student Name</x-table.header-cell>
                                    <x-table.header-cell class="py-1" :scope="__('col')">Grade Lvl</x-table.header-cell>
                                    <x-table.header-cell class="py-1" :scope="__('col')">Strand</x-table.header-cell>
                                </tr>
                            </x-table.head>
                            <x-table.body>
                                @forelse ($students as $stu)
                                    <tr class="bg-white border-b">
                                        @php
                                            $stu_info = $stu->student;
                                            $enrolment_info = $stu_info->currentEnrolment();
                                        @endphp
                                        <x-table.header-cell class="py-1"
                                            :scope="__('row')">{{ $stu_info->lrn }}</x-table.header-cell>
                                        <x-table.regular-cell
                                            class="py-1">{{ $stu_info->getFullName() }}</x-table.regular-cell>
                                        <x-table.regular-cell
                                            class="py-1">{{ $enrolment_info->grade_level }}</x-table.regular-cell>
                                        <x-table.regular-cell
                                            class="py-1">{{ $enrolment_info->strand->abbr }}</x-table.regular-cell>
                                    </tr>
                                @empty
                                    <tr class="bg-white border-b">
                                        <x-table.regular-cell class="py-1" colspan="4" class="text-center">No students
                                            found.</x-table.regular-cell>
                                    </tr>
                                @endforelse
                            </x-table.body>
                        </x-table.wrapper> --}}
                    </div>
                @break

                @case('faculties')
                    <div class="mt-8 flex flex-col gap-y-6 text-[12pt]">
                        <h2 class="font-bold">Faculties by department (%)</h2>

                        <div class="aspect-square mx-auto">
                            <div x-data="facultiesByDeptChart()" x-init="render()" x-cloak
                                x-show="document.getElementById('facultiesByDeptChartCanvas') !== null"
                                class="h-full py-2 flex items-center">
                                <div id="facultiesByDeptChartCanvas" class="w-full">

                                </div>
                            </div>
                        </div>

                        <div class="font-bold"><span>Total faculties:</span> <span>{{ $faculties->count() }}</span></div>

                        {{-- <h2 class="font-bold">List of faculties</h2>

                        <x-table.wrapper>
                            <x-table.head>
                                <tr>
                                    <x-table.header-cell :scope="__('col')">Full Name</x-table.header-cell>
                                    <x-table.header-cell :scope="__('col')">Department</x-table.header-cell>
                                </tr>
                            </x-table.head>
                            <x-table.body>
                                @forelse ($faculties as $fac)
                                    <tr class="bg-white border-b">
                                        <x-table.header-cell
                                            :scope="__('row')">{{ $fac->user->profile->getFullName() }}</x-table.header-cell>
                                        <x-table.regular-cell>{{ $fac->department->name }}</x-table.regular-cell>
                                    </tr>
                                @empty
                                    <tr class="bg-white border-b">
                                        <x-table.regular-cell colspan="2" class="text-center">No faculties
                                            found.</x-table.regular-cell>
                                    </tr>
                                @endforelse
                            </x-table.body>
                        </x-table.wrapper> --}}
                    </div>
                @break

                @default
            @endswitch
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0/dist/quill.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/venobox/2.0.4/venobox.min.js"
        integrity="sha512-KX9LF4BMXOG6qr9aGjFIPK1xysZAHWXpuZW6gnRi6oM+41qa8x4zaLPkckNxz5veoSWzmV5HZqPMMtknU+431g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @switch($report)
        @case('dashboard')
            <script>
                function acquisitionsChart() {
                    return {
                        options: {
                            series: [{
                                name: "Total Matches",
                                data: @json($acquisitions)
                            }, ],
                            chart: {
                                height: 350,
                                type: 'line',
                                dropShadow: {
                                    enabled: true,
                                    color: '#000',
                                    top: 18,
                                    left: 7,
                                    blur: 10,
                                    opacity: 0.2
                                },
                                zoom: {
                                    enabled: false
                                },
                                toolbar: {
                                    show: false
                                }
                            },
                            colors: ['#23a7c4'],
                            dataLabels: {
                                enabled: true,
                            },
                            stroke: {
                                curve: 'smooth'
                            },
                            grid: {
                                borderColor: '#e7e7e7',
                                row: {
                                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                    opacity: 0.5
                                },
                            },
                            markers: {
                                size: 1
                            },
                            xaxis: {
                                categories: @json($month_names),
                                title: {
                                    text: 'Month'
                                }
                            },
                            yaxis: {
                                title: {
                                    text: 'Total'
                                },
                            },
                            legend: {
                                position: 'top',
                                horizontalAlign: 'right',
                                floating: true,
                                offsetY: -25,
                                offsetX: -5
                            }
                        },
                        // options: {
                        //     series: [{
                        //         name: "No. of acquisitions",
                        //         data: [10, 41, 35, 51]
                        //     }],
                        //     chart: {
                        //         height: 350,
                        //         type: 'line',
                        //         zoom: {
                        //             enabled: false
                        //         }
                        //     },
                        //     dataLabels: {
                        //         enabled: false
                        //     },
                        //     stroke: {
                        //         curve: 'straight'
                        //     },
                        //     title: {
                        //         text: 'Document Acquisitions Data',
                        //         align: 'left'
                        //     },
                        //     grid: {
                        //         row: {
                        //             colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        //             opacity: 0.5
                        //         },
                        //     },
                        //     xaxis: {
                        //         categories: ['Jan', 'Feb', 'Mar', 'Apr', ],
                        //     }
                        // },

                        render() {
                            return new ApexCharts(document.getElementById('acquisitionsChartCanvas'), this.options)
                                .render();
                        }
                    }
                }
            </script>
        @break

        @case('enrolled-students')
            <script>
                function studentsByStrandChart() {
                    return {
                        options: {
                            series: @json($students_count),
                            chart: {
                                type: 'donut',
                            },
                            labels: @json($strand_names),
                            responsive: [{
                                breakpoint: 480,
                                options: {
                                    chart: {
                                        width: 600
                                    },
                                    legend: {
                                        position: 'bottom'
                                    }
                                }
                            }]
                        },

                        render() {
                            return new ApexCharts(document.getElementById('studentsByStrandChartCanvas'), this.options).render();
                        }
                    }
                }
            </script>
        @break

        @case('faculties')
            <script>
                function facultiesByDeptChart() {
                    return {
                        options: {
                            series: @json($faculties_by_dept),
                            chart: {
                                type: 'donut',
                            },
                            labels: @json($dept_names),
                            responsive: [{
                                breakpoint: 480,
                                options: {
                                    chart: {
                                        width: 600
                                    },
                                    legend: {
                                        position: 'bottom'
                                    }
                                }
                            }]
                        },

                        render() {
                            return new ApexCharts(document.getElementById('facultiesByDeptChartCanvas'), this.options).render();
                        }
                    }
                }
            </script>
        @break

        @default
    @endswitch
</body>

</html>
