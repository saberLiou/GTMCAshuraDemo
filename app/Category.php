<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasEnabled;

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'slug',
        'name',
        'description',
        'enabled',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
