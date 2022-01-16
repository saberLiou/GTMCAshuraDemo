<?php

namespace App;

trait HasTranslations
{
    /**
     * Get the class name of its translation model for the model.
     *
     * @return string
     */
    protected static function getTranslationClass()
    {
        return static::class . 'Translation';
    }

    /**
     * Get the translations for the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations()
    {
        return $this->hasMany(self::getTranslationClass());
    }

    /**
     * Get the en translation for the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function en()
    {
        return $this->hasOne(self::getTranslationClass())->where('locale', __FUNCTION__);
    }

    /**
     * Get the zh-tw translation for the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function zhtw()
    {
        return $this->hasOne(self::getTranslationClass())->where('locale', __FUNCTION__);
    }

    /**
     * Get the es translation for the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function es()
    {
        return $this->hasOne(self::getTranslationClass())->where('locale', __FUNCTION__);
    }
}
