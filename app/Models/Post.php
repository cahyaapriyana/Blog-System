<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    // protected $fillable = ['title', 'body', 'category_id', 'author_id', 'slug'];
    protected $guarded = ['id'];

    protected $with = ['author', 'category'];

    public function author(): BelongsTo
    {
        return $this->belongsto(user::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsto(Category::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->approved()->topLevel()->with('replies.user');
    }

    public function allComments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when( $filters['search'] ?? false, function($query, $search) {
           return $query->where('title', 'like', '%' . $search . '%');

        });
        $query->when( $filters['category'] ?? false, function($query, $category) {
            return $query->whereHas('category', fn (Builder $query) =>
                $query->where('slug', $category)
            );
 
         });

         $query->when( $filters['author'] ?? false, function($query, $author) {
            return $query->whereHas('author', fn (Builder $query) =>
                $query->where('username', $author)
            );
 
         });
    }
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'author_id');
    }
}



