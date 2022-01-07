<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'post_id',
        'locale', // en, zh-tw
        'name',
        'description',
        'active',
    ];
}
