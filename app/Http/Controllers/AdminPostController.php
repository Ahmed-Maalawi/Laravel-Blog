<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(30)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // if (auth()->guest()) {
        //     abort(Response::HTTP_FORBIDDEN);
        // }

        // return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Post::create(array_merge($this->validatePostRequest(), [
            'user_id' => auth()->id(),
            'thumbnail' => $request->file('thumbnail')->store('thumbnails'),
            'slug' => Str::slug($request['title'], '-'),
        ]));

       $attributes = $this->validatePostRequest();


        

        $post = Post::create($attributes);

        return to_route('post.view', $post)->with('your post is published');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
       return view('admin.posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Post $post)
    {

        $attributes = $this->validatePostRequest();

        if($attributes['thumbnail'] ?? false) {

            $attributes['thumbnail'] = request()->file('thumbnail')->file('thumbnails');
        }

        $post->update($attributes);

        return back()->with('success', 'post updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Post::destroy($id);

        return to_route('home')->with('post deleted successfully');
    }

    protected function validatePostRequest(?Post $post = null): array
    {
        $post = new Post();

        return request()->validate([
            'title' => 'required|min:3',
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => 'required|min:3',
            'thumbnail' => $post->exists() ? 'image' : 'required|image',
            'body' => 'required|min:3',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);
    }
}
