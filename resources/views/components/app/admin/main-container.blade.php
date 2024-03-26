<x-app.base>
    <x-slot name="sidebar">
        <x-sidebar.wrapper>
            <x-sidebar.link href="{{ route('home') }}">Dashboard</x-sidebar.link>
            <x-sidebar.dropdown.container>
                Academic
                <x-slot name="dropdownItems">
                    <x-sidebar.link>Manage Academic Years</x-sidebar.link>
                    <x-sidebar.link>Manage Strands</x-sidebar.link>
                    <x-sidebar.link>Manage Subjects</x-sidebar.link>
                    <x-sidebar.link>Manage Sections</x-sidebar.link>
                </x-slot>
            </x-sidebar.dropdown.container>
            <x-sidebar.dropdown.container>
                Faculty
                <x-slot name="dropdownItems">
                    <x-sidebar.link>Manage Faculties</x-sidebar.link>
                    <x-sidebar.link>Manage Departments</x-sidebar.link>
                </x-slot>
            </x-sidebar.dropdown.container>
            <x-sidebar.link>Students</x-sidebar.link>
            <x-sidebar.dropdown.container>
                Misc
                <x-slot name="dropdownItems">
                    <x-sidebar.link>Verified Users</x-sidebar.link>
                    <x-sidebar.link>Unverified Users</x-sidebar.link>
                    <x-sidebar.link>Document Guides</x-sidebar.link>
                    <x-sidebar.link>Reports</x-sidebar.link>
                </x-slot>
            </x-sidebar.dropdown.container>
        </x-sidebar.wrapper>
    </x-slot>

    <x-container class="py-5">
        {{ $slot }}
    </x-container>
</x-app.base>
