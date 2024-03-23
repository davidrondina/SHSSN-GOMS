@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-fs font-semibold text-sm uppercase']) }}>
    {{ $value ?? $slot }}
</label>
