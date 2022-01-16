<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
     * Get the posts of the category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
