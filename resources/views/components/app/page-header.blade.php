@props(['show_back_btn' => false, 'back_btn_url', 'show_title' => false, 'title'])

<div class="w-full mb-5 flex flex-col gap-y-2">
    @if ($show_back_btn)
        <div class="mb-3">
            <a href="{{ $back_btn_url }}" class="btn btn-sm inline-flex items-center gap-x-2"><i
                    class="fa-solid fa-arrow-left"></i>Back</a>
        </div>
    @endif

    <div class="flex justify-between items-center">
        @if ($show_title)
            <h1 class="self-start font-bold text-2xl">
                {{ $title }}
            </h1>
        @endif

        @if (isset($controls))
            {{ $controls }}
        @endif
    </div>
</div>
