<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'tracking-wider btn btn-primary inline-flex items-center font-semibold font-fs uppercase']) }}>
    {{ $slot }}
</button>
