<x-app.admin.main-container>
    <main class="w-full flex-grow">
        <x-app.page-header :show_title="true" :title="__('Document Guides')" />

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-sm">
            @foreach ($document_guides as $dg)
                <div x-data="feedbackCard({{ $dg->id }})" class="bg-white h-fit p-4 flex flex-col gap-y-2">
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-base">{{ $dg->name }}</span>
                        <div class="tooltip" data-tip="Edit">
                            <a href="{{ route('admin.guides.edit', $dg->id) }}" class="text-primary"><i
                                    class="fa-solid fa-edit"></i></a>
                        </div>
                    </div>
                    <div x-cloak x-show="!previewHidden" id="previewWrapper{{ $dg->id }}"
                        class="h-[1000px] max-h-24">
                        <div class="prose prose-sm text-gray-600 line-clamp-3 text-ellipsis">{!! $dg->description !!}
                        </div>
                    </div>
                    <div x-cloak x-show="previewHidden" id="contentWrapper{{ $dg->id }}" x-init="checkContentHeight()"
                        class="min-h-24">
                        <div id="wholeContent{{ $dg->id }}" class="prose prose-sm text-gray-600">
                            {!! $dg->description !!}</div>
                    </div>
                    <div x-cloak x-show="open" id="toggleButtonWrapper{{ $dg->id }}"><button
                            id="toggleButton{{ $dg->id }}" x-text="previewHidden ? 'Show less' : 'Read more'"
                            @click="toggle()" class="btn-link"></button></div>
                </div>
            @endforeach
        </div>
    </main>
</x-app.admin.main-container>
