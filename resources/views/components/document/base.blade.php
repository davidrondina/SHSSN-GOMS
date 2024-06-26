@props(['title' => 'Page title'])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    @stack('head')

    @vite(['resources/css/document.css'])
</head>

<body id="body">
    {{ $slot }}

    {{-- @stack('js') --}}
</body>

</html>
