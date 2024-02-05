<?php

namespace App\Providers;

use Illuminate\Support\Arr;
use App\Settings\SitesSettings;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(SitesSettings $siteSettings): void
    {
        // Skip execution during migrations
        if ($this->app->runningInConsole()) {
            return;
        }
        // Set dynamic values for name and timezone with fallbacks
        config(['app.name' => $siteSettings->name ?? config('app.name')]);
        config(['app.timezone' => $siteSettings->timezone ?? config('app.timezone')]);
        // Get the locales from the config file
        $localesConfig = LaravelLocalization::getSupportedLocales();

        // If $siteSettings->locales is not empty, create an associative array with key-value pairs
        $localesAssociative = !empty($siteSettings->locales)
            ? Arr::only($localesConfig, $siteSettings->locales)
            : config('app.locales');

        // Set the locales into the config
        config(['laravellocalization.supportedLocales' => $localesAssociative]);
    }
}
