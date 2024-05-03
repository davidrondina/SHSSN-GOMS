@props(['title' => 'Page title'])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    <style>
        @font-face {
            font-family: 'Bookman Old Style';
            src: url({{ storage_path('fonts/bookman-old-style-regular.ttf') }});
            font-style: normal;
            font-weight: normal;
        }

        @font-face {
            font-family: 'Bookman Old Style';
            src: url({{ storage_path('fonts/bookman-old-style-bold.otf') }});
            font-style: normal;
            font-weight: bold;
        }

        body {
            font-family: 'Bookman Old Style', serif;
        }
    </style>

    @vite(['resources/css/document.css'])
</head>

<body id="body">
    {{ $slot }}

    {{-- @stack('js') --}}
</body>

</html>
