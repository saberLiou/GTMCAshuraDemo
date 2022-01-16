<?php

/*
|--------------------------------------------------------------------------
| Helpers for url.
|--------------------------------------------------------------------------
*/

if (!function_exists('is_admin_url')) {
    /**
     * Determine if the url of the request is for admin.
     *
     * @return boolean
     */
    function is_admin_url()
    {
        return request()->is(config('admin.route.prefix') . '*');
    }
}

/*
|--------------------------------------------------------------------------
| Helpers for config.
|--------------------------------------------------------------------------
*/

if (!function_exists('locales')) {
    /**
     * Get all the locales with translation, or translation of the specified locale.
     *
     * @param string|null $key
     * @return array
     */
    function locales(string $locale = null)
    {
        return is_null($locale) ? config('app.locales') : config("app.locales.$locale", '');
    }
}
