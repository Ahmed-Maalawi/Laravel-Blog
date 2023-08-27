<x-layout>

    <x-setting heading="Add New Post">

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <x-form.input name="title"/>
            <x-form.input name="slug"/>
            <x-form.textarea name="excerpt"/>
            <x-form.textarea name="body"/>
            <x-form.input type="file" name="thumbnail"/>


            <x-form.field class="mb-6">
                <x-form.label name="category_id"/>


                <select name="category_id" id="category_id" class="text-sm font-semibold bg-gray-200 rounded-full py-2 px-4">
                    <option value="" selected disabled>select category</option>
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category['id'] }}" {{ old('category_id') === $category['id'] ? 'selected' : '' }}>{{ $category['name'] }}</option>
                    @endforeach
                </select>

                <x-form.error name="category_id"/>
            </x-form.field>

            <div class="mb-6">
                <input type="submit" class="hover:bg-blue-400 group flex items-center rounded-md bg-blue-500 text-white text-sm font-medium pl-2 pr-3 py-2 shadow-sm" value="publish">
            </div>
        </form>

    </x-setting>   
   
</x-layout>
