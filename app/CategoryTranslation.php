<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    use HasEnabled,
        HasTranslated;

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'post_id',
        'locale',
        'name',
        'description',
        'active',
    ];
}
