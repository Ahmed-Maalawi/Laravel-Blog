<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{

    public function index()
    {

        Gate::allows('admin');


        return view('posts.index', [
            'posts' => Post::latest()
                ->filter(request(['search', 'category', 'author']))
                ->paginate(9)
                ->withQueryString()
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function create()
    {

        if (auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return view('posts.create');
    }

    public function store(Request $request)
    {

        $attributes = $request->validate([
            'title' => 'required|min:3',
            'slug' => ['required', Rule::unique('posts', 'slug')],
            'excerpt' => 'required|min:3',
            'thumbnail' => 'required|image',
            'body' => 'required|min:3',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);


        $attributes['user_id'] = auth()->id();

        $attributes['slug'] = Str::slug($attributes['title'], '-');

        $attributes['thumbnail'] = $request->file('thumbnail')->store('thumbnails');

        $post = Post::create($attributes);

        return to_route('post.view', $post)->with('your post is published');
    }

}


