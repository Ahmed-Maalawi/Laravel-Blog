<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'post_id', 'body', 'category_id', 'title', 'slug', 'excerpt', 'thumbnail'
    ];

    protected $with = ['author', 'category'];

    public function scopeFilter($query, array $filters)
    {
//        -----------------------  search filter  --------------------------
        $query->when($filters['search']?? false, fn($query, $search) =>
            $query->when(fn($query) =>
                $query->where('title', 'like', '%' . request('search') . '%')
                    ->orWhere('body', 'like', '%' . request('search') . '%')
            )
        );


//        ----------------------  category filter  ------------------------
        $query->when($filters['category'] ?? false, fn($query, $category) =>
            $query->whereHas('category', fn($query) =>
                $query->where('slug', $category)
            )
        );

//        -----------------------  author filter  -------------------------
        $query->when($filters['author'] ?? false, fn($query, $author) =>
            $query->whereHas('author', fn($query) =>
                $query->where('name', $author)
            )
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

//    public function coments()
//    {
//        return $this->hasMany(Comment::class);
//    }
}
