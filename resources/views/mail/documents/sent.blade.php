<x-mail::message>
# Document Request Successful

Hi {{ $recipient->profile->first_name }},

Here attached is the link to the document that you requested. Click the link below to download the file.

Please refer to the instructions shown in the website after downloading the file.

<x-mail::button :url="$document->url">
    Click here to download the file
</x-mail::button>

You must <strong>download</strong> the file document before the link <strong>expires in 48 hours</strong> after this email was sent.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

{{-- <x-mail::message>
    # Introduction

    The body of your message.
    {{ $type }}

    <x-mail::button :url="'#'">
        Download File
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message> --}}
