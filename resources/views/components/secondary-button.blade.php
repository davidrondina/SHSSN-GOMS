<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'tracking-wider btn btn-secondary inline-flex items-center font-semibold font-fs uppercase']) }}>
    {{ $slot }}
</button>
