<x-app.base>
    <x-slot name="sidebar">
        <x-sidebar.wrapper>
            <x-sidebar.link href="{{ route('home') }}"
                class="{{ Request::routeIs('counselor.dashboard') ? 'bg-[#2a447a]' : '' }}">Dashboard</x-sidebar.link>
            <x-sidebar.link href="#"
                class="{{ Request::routeIs('admin.students.*') ? 'bg-[#2a447a]' : '' }}">Advisory</x-sidebar.link>
            <x-sidebar.link href="#"
                class="{{ Request::routeIs('counselor.appointments.*') ? 'bg-[#2a447a]' : '' }}">My
                Classes</x-sidebar.link>
            <x-sidebar.link href="#" class="{{ Request::routeIs('admin.students.*') ? 'bg-[#2a447a]' : '' }}">My
                Complaints</x-sidebar.link>
        </x-sidebar.wrapper>
    </x-slot>

    <x-container class="py-5">
        {{ $slot }}
    </x-container>
</x-app.base>
