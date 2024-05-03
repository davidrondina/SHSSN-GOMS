@props(['type' => 'info'])

@php
    $icon = [
        'success' => 'fa-solid fa-circle-check',
        'error' => 'fa-solid fa-circle-exclamation',
        'warning' => 'fa-solid fa-triangle-exclamation',
        'info' => 'fa-solid fa-circle-info',
    ][$type];

    $bg_color = [
        'success' => 'alert-success',
        'error' => 'alert-error',
        'warning' => 'alert-warning',
        'info' => 'alert-info',
    ][$type];
@endphp

<div role="alert" {{ $attributes->merge(['class' => 'alert alert-info']) }}>
    <i class="{{ $icon }}"></i>
    {{ $slot }}
</div>
