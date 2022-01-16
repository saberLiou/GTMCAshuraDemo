<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasEnabled,
        HasTranslations;

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'slug',
        'name',
        'description',
        'enabled',
    ];

    /**
     * {@inheritDoc}
     */
    protected $casts = [
        'name' => 'array',
        'description' => 'array',
    ];

    /**
     * Get the categories of the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
