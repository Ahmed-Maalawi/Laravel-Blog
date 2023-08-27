<x-layout>

    <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
        <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="" class="rounded-xl">

            <p class="mt-4 block text-gray-400 text-xs">
                Published <time>{{ $post['created_at']->diffForHumans() }}</time>
            </p>

            <div class="flex items-center lg:justify-center text-sm mt-4">
                <img src="./../images/lary-avatar.svg" alt="Lary avatar">
                <div class="ml-3 text-left">
                    <h5 class="font-bold">{{ $post['author']->name }}</h5>
                </div>
            </div>
        </div>

        <div class="col-span-8">
            <div class="hidden lg:flex justify-between mb-6">
                <a href="/"
                   class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                    <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                        <g fill="none" fill-rule="evenodd">
                            <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                            </path>
                            <path class="fill-current"
                                  d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                            </path>
                        </g>
                    </svg>

                    Back to Posts
                </a>

                <div class="space-x-2">
                    <x-category-button :category="$post->category" />
                </div>
            </div>

            <h1 class="font-bold text-3xl lg:text-4xl mb-10">
                {{ $post['title'] }}
            </h1>

            <div class="space-y-4 lg:text-lg leading-loose">


                {!! $post['body'] !!}
            </div>
        </div>

       @if($post->comments)
            <section class="col-span-8 col-start-5 mt-10 space-y-6">
                @auth
                    <x-panel>
                        <form action="{{ route('comment.store', $post) }}" method="POST">
                            @csrf

                            <header class="flex items-center">
                                <img src="http://i.pravatar.cc/60/u={{ auth()->id() }}" class="rounded-full" alt="test" width="40" height="40">

                                <h2 class="ml-4">want to participate?</h2>
                            </header>

                            <div class="mt-4">
                            <textarea
                                class="w-full text-sm focus:outline-none focus:ring"
                                name="body"
                                id="body"
                                rows="5"
                                placeholder="Quick, think of something to say!"
                            ></textarea>
                            </div>

                            <div class="flex justify-end mt-4 border-t border-gray-100 p-4">
                                <button type="submit" class="bg-blue-500 uppercase text-sm font-semibold px-10 py-2 rounded-2xl text-white hover:bg-blue-600">post</button>
                            </div>
                        </form>
                    </x-panel>
                @else
                    <p class="text-semibold p-4 rounded-xl bg-blue-100 text-center">
                        <a class="text-blue-500 hover:underline text-bold" href="{{ route('register') }}">Register</a> or <a class="text-blue-500 hover:underline text-bold" href="{{ route('login') }}">Login</a> to leave a comment !!.
                    </p>
                @endauth


                @foreach($post->comments as $comment)
                    <x-post-comment :comment="$comment" />
                @endforeach
            </section>
        @else
           <h3>no comments found!</h3>
        @endif
    </article>



</x-layout>