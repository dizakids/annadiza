<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
         'path',
         'description',
        'status',
      'menu',
    ];

    public function articles()
    {
        return $this->hasOne(Article::Class);
    }

    public function children()
    {
        return $this->hasMany(Article::class, 'parent_id');
    }
}
