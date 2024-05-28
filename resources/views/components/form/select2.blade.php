@props([
    'options' => [],
    'options_selected' => null,
    /*
     * Insert an array of selected options that relate to a model (e.g. Post, as it can have many tags selected)
     * to pre-select them when performing actions such as edit
     */
    'required' => true,
])

<select {!! $attributes->merge([
    'class' =>
        'block w-full h-[200px] max-h-[150px] p-2 pb-4 border border-gray-300 focus:outline-none focus:ring-0 focus:border-theme-green focus:border-2 overflow-y-auto rounded-lg',
]) !!} style="width: 100%;" multiple="multiple" {{ $required ? 'required' : '' }}>

    {{ $slot }}

</select>
