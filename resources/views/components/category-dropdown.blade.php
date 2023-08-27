<x-dropdown>

    <x-slot name="trigger">
        <button class="appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold text-left lg:inline-flex lg:w-32">
            {{ isset($currentCategory)? ucwords($currentCategory->name) : 'Category' }}

            <x-icon name="down-arrow" />

        </button>
    </x-slot>

    <a
        href="/?{{ http_build_query(request()->except('category', 'page')) }}"
        :active="{{ request()->routeIs('home') }}"
        class="block text-left px-3 text-sm leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white"
    >
        All
    </a>
    @foreach($categories as $category)

        <x-dropdown-item href="/?category={{ $category['slug'] }}&{{ http_build_query(request()->except('category', 'page')) }} " :active="isset($currentCategory) && $currentCategory->is($category)">
            {{ ucwords($category['name']) }}
        </x-dropdown-item>
    @endforeach
</x-dropdown>
