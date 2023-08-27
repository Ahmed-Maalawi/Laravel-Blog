@props(['trigger'])

<div
    class="relative"
    x-data="{ isOpen: false }"
    @click.away="isOpen = false"
>
    {{-- Trigger --}}
    <div @click="isOpen = !isOpen">
        {{ $trigger }}
    </div>

    {{--  Links  --}}
    <div
        class="py-2 absolute bg-gray-100 w-full mt-4 rounded-xl w-32 z-50 overflow-auto max-h-52"
        x-show="isOpen"
        style="display: none"
    >
        {{ $slot }}
    </div>


</div>
