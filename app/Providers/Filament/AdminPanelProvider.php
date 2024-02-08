<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Awcodes\Overlook;
use Filament\PanelProvider;
use LaraZeus\Bolt\BoltPlugin;
use Awcodes\Curator\CuratorPlugin;
use Filament\Support\Colors\Color;
use Hasnayeen\Themes\ThemesPlugin;
use Filament\Support\Enums\MaxWidth;
use RickDBCN\FilamentEmail\FilamentEmail;
use Awcodes\LightSwitch\LightSwitchPlugin;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Kenepa\ResourceLock\ResourceLockPlugin;
use Awcodes\FilamentVersions\VersionsPlugin;
use Filament\SpatieLaravelTranslatablePlugin;
use Hasnayeen\Themes\Http\Middleware\SetTheme;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Awcodes\FilamentQuickCreate\QuickCreatePlugin;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Brickx\MaintenanceSwitch\MaintenanceSwitchPlugin;
use FilipFonal\FilamentLogManager\FilamentLogManager;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Kenepa\ResourceLock\Resources\ResourceLockResource;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Yebor974\Filament\RenewPassword\RenewPasswordPlugin;
use lockscreen\FilamentLockscreen\Http\Middleware\Locker;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use SolutionForest\FilamentFirewall\FilamentFirewallPanel;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use BezhanSalleh\FilamentExceptions\FilamentExceptionsPlugin;
use Croustibat\FilamentJobsMonitor\FilamentJobsMonitorPlugin;
use SolutionForest\FilamentSimpleLightBox\SimpleLightBoxPlugin;
use pxlrbt\FilamentEnvironmentIndicator\EnvironmentIndicatorPlugin;
use Tapp\FilamentAuthenticationLog\FilamentAuthenticationLogPlugin;
use Amendozaaguiar\FilamentRouteStatistics\FilamentRouteStatisticsPlugin;
use ShuvroRoy\FilamentSpatieLaravelBackup\FilamentSpatieLaravelBackupPlugin;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->viteTheme(['resources/css/filament/admin/theme.css', 'resources/js/filament/admin/scroll-fix.js'])
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Blue,
            ])
            ->navigationGroups([
                'CMS',
                'Content',
                'Blog Management',
                'Dynamic Forms',
                'Surveys',
                'Statistics',
                'User Management',
                'Settings',
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Overlook\Widgets\OverlookWidget::class,
            ])
            ->databaseNotifications()
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                SetTheme::class,
            ])
            ->authMiddleware([
                'auth',
                Locker::class,
            ])->spa()
            ->maxContentWidth(MaxWidth::Full)
            ->sidebarCollapsibleOnDesktop()
            ->plugins([
                ResourceLockPlugin::make(),
                RenewPasswordPlugin::make()
                    ->timestampColumn('password_changed_at'),
                QuickCreatePlugin::make()
                    ->excludes([
                        ResourceLockResource::class,
                    ])->sortBy('navigation'),
                CuratorPlugin::make()
                    ->label('Media')
                    ->pluralLabel('Media')
                    ->navigationIcon('heroicon-o-photo')
                    ->navigationCountBadge(),
                ThemesPlugin::make()
                    ->registerTheme([
                        \Hasnayeen\Themes\Themes\Sunset::class,
                    ]),
                FilamentAuthenticationLogPlugin::make(),
                new FilamentEmail(),
                FilamentExceptionsPlugin::make(),
                FilamentShieldPlugin::make()->gridColumns([
                    'default' => 1,
                    'sm' => 2,
                    'lg' => 3
                ])->sectionColumnSpan(1)
                    ->checkboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                        'lg' => 4,
                    ])->resourceCheckboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                    ]),
                Overlook\OverlookPlugin::make()
                    ->sort(2)
                    ->columns([
                        'default' => 1,
                        'sm' => 2,
                        'md' => 3,
                        'lg' => 4,
                        'xl' => 5,
                        '2xl' => null,
                    ]),
                VersionsPlugin::make(),
                BreezyCore::make()->myProfile(
                    shouldRegisterNavigation: true
                )->enableTwoFactorAuthentication(),
                MaintenanceSwitchPlugin::make(),
                FilamentJobsMonitorPlugin::make(),
                FilamentFirewallPanel::make(),
                FilamentLogManager::make(),
                EnvironmentIndicatorPlugin::make()->showBorder(false),
                FilamentSpatieLaravelBackupPlugin::make()
                    ->usingQueue('backups'),
                FilamentSpatieLaravelHealthPlugin::make(),
                SpatieLaravelTranslatablePlugin::make()->defaultLocales($getLocales ?? ['en']),
                BoltPlugin::make()
                    ->navigationGroupLabel('Dynamic Forms'),
                LightSwitchPlugin::make(),
                FilamentRouteStatisticsPlugin::make(),
                SimpleLightBoxPlugin::make(),
            ]);
    }
}
