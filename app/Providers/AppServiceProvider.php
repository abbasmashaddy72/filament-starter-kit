<?php

namespace App\Providers;

use App\Settings\SitesSettings;
use Spatie\Health\Facades\Health;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Spatie\CpuLoadHealthCheck\CpuLoadCheck;
use Spatie\Health\Checks\Checks\CacheCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\DatabaseSizeCheck;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use BezhanSalleh\FilamentShield\Facades\FilamentShield;
use Spatie\Health\Checks\Checks\DatabaseConnectionCountCheck;
use Spatie\SecurityAdvisoriesHealthCheck\SecurityAdvisoriesCheck;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        app()->useLangPath(base_path('lang'));
        Model::unguard();
        Health::checks([
            CacheCheck::new(),
            OptimizedAppCheck::new(),
            CpuLoadCheck::new()
                ->failWhenLoadIsHigherInTheLast5Minutes(2.0)
                ->failWhenLoadIsHigherInTheLast15Minutes(1.5),
            DatabaseCheck::new(),
            DatabaseConnectionCountCheck::new()
                ->failWhenMoreConnectionsThan(100),
            DatabaseSizeCheck::new()
                ->failWhenSizeAboveGb(errorThresholdGb: 5.0),
            DebugModeCheck::new(),
            EnvironmentCheck::new(),
            SecurityAdvisoriesCheck::new(),
            UsedDiskSpaceCheck::new(),
        ]);
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch->visible(outsidePanels: false)
                ->locales($this->getLocales());
        });
        FilamentShield::configurePermissionIdentifierUsing(
            function ($resource) {
                $str = str($resource::getModel())
                    ->prepend('::')->toString();
                return $str;
            }
        );
        view()->share('getLocales', $this->getLocales());
    }

    function getLocales(): array
    {
        // Skip execution during migrations
        if (app()->runningInConsole()) {
            return [];
        }
        // Access the locales property directly as an array
        $locales = app(SitesSettings::class)->locales ?? [];

        // Remove 'en' if present
        $locales = array_diff($locales, ['en']);

        // Ensure 'en' is the first element
        array_unshift($locales, 'en');

        return $locales;
    }
}
