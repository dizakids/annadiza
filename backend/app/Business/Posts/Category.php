<?php

namespace App\Business\Posts;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    public $timestamps = false;
    use NodeTrait;
    protected $fillable = ["name"];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
