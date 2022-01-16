<?php

namespace App;

use Illuminate\Support\Arr;

trait HasTranslated
{
    /**
     * The attributes that should be backed up to the translated model.
     *
     * @var array
     */
    protected static $backupTranslated = [
        'name',
        'description',
    ];

    /**
     * Boot the Model with HasTranslated.
     *
     * @return void
     */
    protected static function bootHasTranslated()
    {
        static::saved(function ($model) {
            if (!is_null($translated = $model->translated)) {
                foreach (self::$backupTranslated ?? [] as $attribute) {
                    $value = $translated->{$attribute};
                    $translated->{$attribute} = Arr::set($value, $model->locale, $model->{$attribute});
                    $translated->save();
                }
            }
        });
    }

    /**
     * Get the translated model of the translation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function translated()
    {
        return $this->belongsTo(
            $translatedName = str_replace('Translation', '', static::class),
            strtolower(class_basename($translatedName)) . '_id'
        );
    }
}
