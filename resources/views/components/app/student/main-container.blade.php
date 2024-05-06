<x-app.base>
    <x-slot name="sidebar">
        <x-sidebar.wrapper>
            <x-sidebar.link href="{{ route('home') }}"
                class="{{ Request::routeIs('student.dashboard') ? 'bg-[#2a447a]' : '' }}">Dashboard</x-sidebar.link>
            <x-sidebar.link href="{{ route('student.services.index') }}"
                class="{{ Request::routeIs('faculty.advisory.*') ? 'bg-[#2a447a]' : '' }}">Services</x-sidebar.link>
            <x-sidebar.link href="{{ route('student.appointments.index') }}"
                class="{{ Request::routeIs('student.appointments.*') ? 'bg-[#2a447a]' : '' }}">Appointments</x-sidebar.link>
            <x-sidebar.link href="{{ route('student.offenses.index') }}"
                class="{{ Request::routeIs('student.offenses.*') ? 'bg-[#2a447a]' : '' }}">Offenses</x-sidebar.link>
        </x-sidebar.wrapper>
    </x-slot>

    <x-container class="py-5">
        {{ $slot }}
    </x-container>
</x-app.base>
