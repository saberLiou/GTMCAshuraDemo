<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
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

    public function getVirtualNameAttribute()
    {
        return 'abc';
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
