<x-mail::message>
# User Verification Failed

Dear user,

Your request for account verification has been rejected due to the following reason: <b>{{ $reason }} @if ($additional_comment) {{ '- ' . $additional_comment }} @endif</b>

Please register again to verify your account.

<x-mail::button :url="'/'">
Go to the website
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
