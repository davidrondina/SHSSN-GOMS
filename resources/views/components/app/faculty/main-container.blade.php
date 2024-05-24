<x-app.base>
    <x-slot name="sidebar">
        <x-sidebar.wrapper>
            <x-sidebar.link href="{{ route('home') }}"
                class="{{ Request::routeIs('faculty.dashboard') ? 'bg-[#2a447a]' : '' }}">Dashboard</x-sidebar.link>
            <x-sidebar.link href="{{ route('faculty.advisory.index') }}"
                class="{{ Request::routeIs('faculty.advisory.*') ? 'bg-[#2a447a]' : '' }}">Advisory</x-sidebar.link>
                <x-sidebar.link href="{{ route('faculty.services.index') }}"
                class="{{ Request::routeIs('faculty.services.*') ? 'bg-[#2a447a]' : '' }}">Services</x-sidebar.link>
            <x-sidebar.link href="{{ route('faculty.classes.index') }}"
                class="{{ Request::routeIs('faculty.classes.*') ? 'bg-[#2a447a]' : '' }}">My
                Classes</x-sidebar.link>
            <x-sidebar.link href="{{ route('faculty.complaints.index') }}"
                class="{{ Request::routeIs('faculty.complaints.*') ? 'bg-[#2a447a]' : '' }}">My
                Complaints</x-sidebar.link>
        </x-sidebar.wrapper>
    </x-slot>

    <x-container class="py-5">
        {{ $slot }}
    </x-container>
</x-app.base>
