<div @click.outside="open = false" x-data="{ open: false }" class="w-full">
    <button @click="open = !open" class="w-full primary-hover flex justify-between items-center py-2 px-3"
        :class="open ? 'bg-[#2a447a]' : ''">
        {{ $slot }}
        <i class="fa-solid" :class="open ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
    </button>

    <div x-cloak x-show="open" x-transition.duration.200ms class="bg-[#2a447a] flex flex-col">
        {{ $dropdownItems }}
    </div>
</div>
