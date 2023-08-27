@props(['name'])

<x-form.field>
    <x-form.label name="{{ $name }}"/>

    <input
        class="border border-gray-200 rounded-xl p-2 w-full"
        id="{{ $name }}"
        name="{{ $name }}"
        {{ $attributes(['value' => old($name)]) }}
    >

    <x-form.error name="{{ $name }}"/>
</x-form.field>