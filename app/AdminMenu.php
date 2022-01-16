<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminMenu extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'admin_menu';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'parent_id',
        'order',
        'title',
        'icon',
        'uri',
        'permission',
    ];
}
