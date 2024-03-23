@props([
    'disabled' => false,
    'selected' => false,
    'value',
    'option_name',
])

<option {{ $disabled ? 'disabled' : '' }} {{ $selected ? 'selected' : '' }} value="{{ $value ?? '' }}">
    {{ $option_name ?? '' }}</option>
