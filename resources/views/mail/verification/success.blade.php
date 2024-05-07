<x-mail::message>
# User Verification Success

Dear user,

Your account has been approved & verified. You are now registered to the website as <b>{{ $student->getFullName() }}</b>, with LRN <b>{{ $student->lrn }}</b>.

You can now login to the website using the email address you provided: <b>{{ $user->email }}</b>

Click the link below to be redirected to the website.

<x-mail::button :url="route('login')">
Click here to login
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
