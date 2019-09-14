<?php

namespace App\Business\Posts;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ["title", "content", "short"];
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
