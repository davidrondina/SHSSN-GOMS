<x-app.admin.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('Dashboard')" />

        <div class="flex flex-col gap-y-4">
            <div class="flex flex-col gap-y-2">
                <h2 class="font-bold text-lg">Overview</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-3 font-fs">
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
                                <span class="text-2xl truncate font-semibold">200000</span>
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
                                <span class="text-2xl truncate font-semibold">200000</span>
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
                                <span class="text-2xl truncate font-semibold">200000</span>
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
                                <span class="text-2xl truncate font-semibold">200000</span>
                            </div>
                        </div>
                    </x-card>
                </div>
            </div>

            <div class="flex flex-col gap-y-2">
                <h2 class="font-bold text-lg">A.Y. {{ $year->getFullYear() }}</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 font-fs">
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
                                <span class="text-2xl truncate font-semibold">200000</span>
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
                                <span class="text-2xl truncate font-semibold">200000</span>
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
    </main>

    @push('js')
        <script>
            function acquisitionsChart() {
                return {
                    options: {
                        series: [{
                            name: "No. of acquisitions",
                            data: [10, 41, 35, 51]
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
                        title: {
                            text: 'Document Acquisitions Data',
                            align: 'left'
                        },
                        grid: {
                            row: {
                                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                opacity: 0.5
                            },
                        },
                        xaxis: {
                            categories: ['Jan', 'Feb', 'Mar', 'Apr', ],
                        }
                    },

                    render() {
                        return new ApexCharts(document.getElementById('acquisitionsChartCanvas'), this.options)
                            .render();
                    }
                }
            }
        </script>
    @endpush
</x-app.admin.main-container>
