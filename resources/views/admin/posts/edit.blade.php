<x-layout>

    <x-setting heading="Edit Post {{ $post['title'] }}">

        <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="title" :value="old('title', $post['title'])" required/>
            <x-form.input name="slug" :value="old('slug', $post['slug'])" required/>
            <x-form.textarea name="excerpt" :value="old('excerpt', $post['excerpt'])" required>{{ old('excerpt', $post['excerpt']) }}</x-form.textarea>
            <x-form.textarea name="body" :value="old('body', $post['body'])" required>{{ old('body', $post['body']) }}</x-form.textarea>
            <x-form.input type="file" name="thumbnail"/>
            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="" class="rounded-xl">


            <x-form.field class="mb-6">
                <x-form.label name="category_id"/>


                <select name="category_id" id="category_id" class="text-sm font-semibold bg-gray-200 rounded-full py-2 px-4">
                    <option value="" selected disabled>select category</option>
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category['id'] }}" {{ $post['category_id'] === $category['id'] ? 'selected' : '' }}>{{ $category['name'] }}</option>
                    @endforeach
                </select>

                <x-form.error name="category_id"/>
            </x-form.field>

            <div class="mb-6">
                <input type="submit" class="hover:bg-blue-400 group flex items-center rounded-md bg-blue-500 text-white text-sm font-medium pl-2 pr-3 py-2 shadow-sm" value="Update">
            </div>
        </form>

    </x-setting>   
   
</x-layout>
