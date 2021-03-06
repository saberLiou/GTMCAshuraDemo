<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
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
