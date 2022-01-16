<?php

namespace App;

trait HasEnabled
{
    /**
     * Boot the Model with HasEnabled.
     *
     * @return void
     */
    protected static function bootHasEnabled()
    {
        static::addGlobalScope('enabled', function ($query) {
            if (!is_admin_url()) {
                if (in_array($modelName = get_class($query->getModel()), [
                    Category::class,
                    Post::class,
                ])) {
                    $query->where('enabled', 1);
                } elseif (in_array($modelName, [
                    PostTranslation::class,
                    CategoryTranslation::class,
                ])) {
                    $query->where('active', 1);
                }
            }
        });
    }
}
