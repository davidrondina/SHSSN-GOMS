<x-app.faculty.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_back_btn="true" :back_btn_url="url()->previous()" />

        {{-- TODO: Render actual data --}}
        <div class="flex gap-x-5">
            <div class="flex-[2_2_0%] flex flex-col gap-y-4">
                <h2 class="text-lg font-bold">Search results for '{{ Request::get('search') }}'</h2>
                @unless (count($students) != 0)
                    <p class="text-gray-500 text-center">No students found.</p>
                @else
                    <x-card class="py-3 px-4">
                        <ul class="flex flex-col gap-y-2 divide-y divide-gray-300">
                            @foreach ($students as $stu)
                                <li>
                                    <a href="{{ route('faculty.students.show', $stu->id) }}"
                                        class="flex justify-between items-center w-full py-1.5 px-2 hover:bg-gray-300 rounded">
                                        <div class="flex flex-col gap-y-1">
                                            <span class="text-base font-semibold">{{ $stu->getFullName() }}</span>
                                            <span class="text-gray-500 text-sm font-semibold">LRN:
                                                {{ $stu->lrn }}</span>
                                        </div>
                                        <div><span
                                                class="text-gray-500 text-sm italic">{{ $stu->isEnrolledToCurrentAY() ? 'Enrolled' : 'Not Enrolled' }}</span>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </x-card>
                @endunless
            </div>

            <div class="flex-1 flex flex-col">
            </div>
        </div>
    </main>
</x-app.faculty.main-container>
