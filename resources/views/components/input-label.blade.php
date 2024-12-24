@props(['value'])

<label {{ $attributes->merge(['class' => 'label label-text']) }}>
    {{ $value ?? $slot }}
</label>
