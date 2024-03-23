@props(['choices', 'placeholder' => 'Placeholder', 'options' => []])

<select {!! $attributes->merge([
    'class' => 'select bg-inherit w-full border-gray-300 focus:border-primary
    focus:ring-primary rounded-md',
]) !!}>
    {{ $slot }}
</select>
