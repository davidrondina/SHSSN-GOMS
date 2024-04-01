@props(['scope' => 'col'])

<th scope="{{ $scope }}" {!! $attributes->merge([
    'class' => $scope === 'col' ? 'px-6 py-3' : 'px-6 py-4 font-semibold text-gray-900 whitespace-nowrap',
]) !!}>{{ $slot }}</th>
