@php
use Carbon\Carbon;
@endphp

<x-mail::message>
# Appointment Notice

Dear guardian,

This is a notice sent by the guidance office in SHS in San Nicolas III, Bacoor City, Cavite, to inform you that the student <strong>{{ $student->getFullName() }}</strong>, has an upcoming appointment this <strong>{{ Carbon::parse($appointment->start_date)->format('l') }}</strong>, <strong>{{ Carbon::parse($appointment->start_date)->format('M d, Y') }}</strong>, <strong>{{ Carbon::parse($appointment->start_date)->format('g:i A') }}</strong>.

We can discuss the concern about the mentioned student through an in-person meeting in the guidance office.

{{-- <x-mail::button :url="''">
Button Text
</x-mail::button> --}}

We're looking forward to your presence,<br>
{{ config('app.name') }}
</x-mail::message>
