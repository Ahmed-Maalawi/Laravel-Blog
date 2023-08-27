@props(['heading'])

<section class="px-6 py-8 max-w-4xl mx-auto">

    <h2 class="font-bold text-2xl uppercase mb-8 border-b ">{{ $heading }}</h2>

    <div class="flex">
        <aside class="w-48 flex-shrank">
            <h3 class="font-semibold text-xl mb-4 border-b">Links</h3>
            <ul>
                <li class="mt-6 {{ request()->routeIs('admin.posts.index') ? 'text-blue-500' : ''}}">
                    <a href="{{ route('admin.posts.index') }}">All Posts</a>
                </li>
                <li class="mt-6 {{ request()->routeIs('post.create')? 'text-blue-500' : '' }}">
                    <a href="{{ route('post.create') }}">New Post</a>
                </li>
            </ul>
        </aside>

        <main class="flex-1">
            <x-panel class="max-w-xl ml-6">
                {{ $slot }}
            </x-panel>
        </main>
    </div>


    
</section>