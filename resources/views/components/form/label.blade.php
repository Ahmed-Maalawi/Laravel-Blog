@props(['name'])

<label class="block mb-2 uppercase font-bold text-xs text-gray-700 mt-10" for="{{ $name }}">
    {{ ucwords($name) }}
</label>