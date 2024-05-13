@php
    use Carbon\Carbon;
@endphp

<x-app.admin.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('Feedback')" />

        <x-tablist.container class="my-3">
            <x-tablist.item href="{{ route('admin.feedback.index') }}"
                class="{{ Request::getRequestUri() === '/admin/feedback' ? 'tab-active font-semibold' : '' }}">5<i
                    class="fa-solid fa-star inline-block ml-2"></i></x-tablist.item>
            <x-tablist.item href="{{ route('admin.feedback.index') . '?rating=4' }}"
                class="{{ Request::getRequestUri() === '/admin/feedback?rating=4' ? 'tab-active font-semibold' : '' }}">4<i
                    class="fa-solid fa-star inline-block ml-2"></i></x-tablist.item>
            <x-tablist.item href="{{ route('admin.feedback.index') . '?rating=3' }}"
                class="{{ Request::getRequestUri() === '/admin/feedback?rating=3' ? 'tab-active font-semibold' : '' }}">3<i
                    class="fa-solid fa-star inline-block ml-2"></i></x-tablist.item>
            <x-tablist.item href="{{ route('admin.feedback.index') . '?rating=2' }}"
                class="{{ Request::getRequestUri() === '/admin/feedback?rating=2' ? 'tab-active font-semibold' : '' }}">2<i
                    class="fa-solid fa-star inline-block ml-2"></i></x-tablist.item>
            <x-tablist.item href="{{ route('admin.feedback.index') . '?rating=1' }}"
                class="{{ Request::getRequestUri() === '/admin/feedback?rating=1' ? 'tab-active font-semibold' : '' }}">1<i
                    class="fa-solid fa-star inline-block ml-2"></i></x-tablist.item>
        </x-tablist.container>

        @unless (count($feedback) == 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-sm">
                @foreach ($feedback as $fb)
                    <div x-data="feedbackCard({{ $fb->id }})" class="bg-white h-fit p-4 flex flex-col gap-y-2">
                        <div class="flex flex-col gap-y-1">
                            <span class="font-semibold text-base">{{ $fb->user->profile->getFullName() }}</span>
                            <span class="text-gray-400">{{ Carbon::parse($fb->created_at)->format('M d, Y') }}</span>
                        </div>
                        <div x-cloak x-show="!previewHidden" id="previewWrapper{{ $fb->id }}"
                            class="h-[1000px] max-h-16">
                            <p class="text-gray-600 line-clamp-3 text-ellipsis">{{ $fb->comment }}</p>
                        </div>
                        <div x-cloak x-show="previewHidden" id="contentWrapper{{ $fb->id }}" x-init="checkContentHeight()"
                            class="min-h-16">
                            <p id="wholeContent{{ $fb->id }}" class="text-gray-600">
                                {{ $fb->comment }}</p>
                        </div>
                        <div x-cloak x-show="open" id="toggleButtonWrapper{{ $fb->id }}"><button
                                id="toggleButton{{ $fb->id }}" x-text="previewHidden ? 'Show less' : 'Read more'"
                                @click="toggle()" class="btn-link"></button></div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center">No feedback found.</p>
        @endunless

        @unless (count($feedback) == 0)
            <div class="my-6">
                {{ $feedback->links() }}
            </div>
        @endunless
    </main>
</x-app.admin.main-container>
