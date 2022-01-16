<?php

namespace App\Admin\Controllers\Traits;

use Illuminate\Support\Str;

trait TitleSettable
{
    /**
     * {@inheritDoc}
     */
    protected function title()
    {
        return Str::plural(str_replace('Controller', '', class_basename(static::class)));
    }
}
