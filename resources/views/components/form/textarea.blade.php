@props(['name'])
<x-form.field>
    <x-form.label name="{{ $name }}"/>

    <textarea
        class="border border-gray-200 rounded-xl p-2 w-full"
        id="{{ $name }}"
        name="{{ $name }}"
        placeholder="enter post excerpt"
        required
    >
        {{ $slot ?? old($name) }}
    </textarea>

    <x-form.error name="{{ $name }}"/>
</x-form.field>
