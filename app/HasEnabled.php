<?php

namespace App;

trait HasEnabled
{
    protected static function bootHasEnabled()
    {
        static::addGlobalScope('enabled', function ($query) {
            if (!request()->is(config('admin.route.prefix') . '/*')) {  // dashboard 未判斷到
                // 可用$query判斷table名稱
                $query->where('enabled', 1);
            }
            return $query;
        });
    }

    protected function initializeHasEnabled()
    {
        $this->append('virtual_name');
    }
}
