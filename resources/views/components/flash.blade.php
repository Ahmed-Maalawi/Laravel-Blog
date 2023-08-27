@if(session()->has('success'))
    <div
        x-data="{show: true}"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        class="bg-blue-500 bottom-0 fixed px-10 py-4 right-0 rounded-xl text-2xl text-white bottom-4">
        <p>{{ session('success') }}</p>
    </div>
@endif
