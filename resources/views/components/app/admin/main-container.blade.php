<x-app.base>
    <x-slot name="sidebar">
        <x-sidebar.wrapper>
            <x-sidebar.link href="{{ route('home') }}">Dashboard</x-sidebar.link>
            <x-sidebar.dropdown.container :pageIsOnMenu="Request::routeIs([
                'admin.academic-years.*',
                'admin.strands.*',
                'admin.subjects.*',
                'admin.sections.*',
            ])">
                Academic
                <x-slot name="dropdownItems">
                    <x-sidebar.link href="{{ route('admin.academic-years.index') }}"
                        class="{{ Request::routeIs('admin.academic-years.*') ? 'bg-[#2a447a]' : '' }}">Manage
                        Academic
                        Years</x-sidebar.link>
                    <x-sidebar.link href="{{ route('admin.strands.index') }}"
                        class="{{ Request::routeIs('admin.strands.*') ? 'bg-[#2a447a]' : '' }}">Manage
                        Strands</x-sidebar.link>
                    <x-sidebar.link href="{{ route('admin.subjects.index') }}"
                        class="{{ Request::routeIs('admin.subjects.*') ? 'bg-[#2a447a]' : '' }}">Manage
                        Subjects</x-sidebar.link>
                    <x-sidebar.link href="{{ route('admin.sections.index') }}"
                        class="{{ Request::routeIs('admin.sections.*') ? 'bg-[#2a447a]' : '' }}">Manage
                        Sections</x-sidebar.link>
                </x-slot>
            </x-sidebar.dropdown.container>
            <x-sidebar.dropdown.container :pageIsOnMenu="Request::routeIs(['admin.faculties.*', 'admin.departments.*'])">
                Faculty
                <x-slot name="dropdownItems">
                    <x-sidebar.link href="{{ route('admin.faculties.index') }}"
                        class="{{ Request::routeIs('admin.faculties.*') ? 'bg-[#2a447a]' : '' }}">Manage
                        Faculties</x-sidebar.link>
                    <x-sidebar.link href="{{ route('admin.departments.index') }}"
                        class="{{ Request::routeIs('admin.departments.*') ? 'bg-[#2a447a]' : '' }}">Manage
                        Departments</x-sidebar.link>
                </x-slot>
            </x-sidebar.dropdown.container>
            <x-sidebar.link href="{{ route('admin.students.index') }}"
                class="{{ Request::routeIs('admin.students.*') ? 'bg-[#2a447a]' : '' }}">Students</x-sidebar.link>
            <x-sidebar.dropdown.container>
                Misc
                <x-slot name="dropdownItems" :pageIsOnMenu="Request::routeIs(['admin.users.verified.*', 'admin.users.unverified.*', 'admin.feedback.index', 'document-guide.index'])">
                    <x-sidebar.link href="{{ route('admin.users.verified.index') }}"
                        class="{{ Request::routeIs('admin.users.verified.*') ? 'bg-[#2a447a]' : '' }}">Verified
                        Users</x-sidebar.link>
                    <x-sidebar.link href="{{ route('admin.users.unverified.index') }}"
                        class="{{ Request::routeIs('admin.users.unverified.*') ? 'bg-[#2a447a]' : '' }}">Unverified
                        Users</x-sidebar.link>
                    <x-sidebar.link href="{{ route('document-guide.index') }}"
                        class="{{ Request::routeIs('document-guide.index') ? 'bg-[#2a447a]' : '' }}">Document
                        Guides</x-sidebar.link>
                    <x-sidebar.link href="{{ route('admin.feedback.index') }}"
                        class="{{ Request::routeIs('admin.feedback.*') ? 'bg-[#2a447a]' : '' }}">Feedback</x-sidebar.link>
                    <x-sidebar.link>Reports</x-sidebar.link>
                </x-slot>
            </x-sidebar.dropdown.container>
        </x-sidebar.wrapper>
    </x-slot>

    <x-container class="py-5">
        {{ $slot }}
    </x-container>
</x-app.base>
