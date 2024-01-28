<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Actions\Action;
use App\Settings\SitesSettings;
use Filament\Pages\SettingsPage;
use Illuminate\Support\Facades\Http;
use Spatie\Sitemap\SitemapGenerator;
use Filament\Notifications\Notification;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;

class SiteSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = SitesSettings::class;

    protected function getActions(): array
    {
        return [
            Action::make('sitemap')->action('generateSitemap')->label(__('Generate Sitemap')),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Group::make()->schema([
                            Forms\Components\FileUpload::make('profile'),
                            Forms\Components\FileUpload::make('logo'),
                            Forms\Components\TextInput::make('phone_code'),
                            Forms\Components\TextInput::make('location'),
                            Forms\Components\TextInput::make('currency'),
                            Forms\Components\TextInput::make('language'),
                        ])->columns(2),
                        Forms\Components\Group::make()->schema([
                            Forms\Components\TextInput::make('name'),
                            Forms\Components\TextInput::make('author'),
                            Forms\Components\TextInput::make('email'),
                            PhoneInput::make('phone')
                                ->focusNumberFormat(PhoneInputNumberType::E164)
                                ->useFullscreenPopup()
                                ->ipLookup(function () {
                                    return rescue(fn () => Http::get('https://ipinfo.io/json')->json('country'), app()->getLocale(), report: false);
                                }),
                            Forms\Components\Textarea::make('address')->columnSpanFull(),
                        ])->columns(2),
                        Forms\Components\Group::make()->schema([
                            Forms\Components\Textarea::make('description'),
                            Forms\Components\Textarea::make('keywords'),
                        ]),
                        Forms\Components\Group::make()->schema([
                            Forms\Components\Repeater::make('social')->schema([
                                Forms\Components\TextInput::make('platform'),
                                Forms\Components\TextInput::make('link')->url(),
                            ])->columns(2),
                        ]),
                    ])->columns(2),
                ]),
            ]);
    }

    public function generateSitemap()
    {
        SitemapGenerator::create(config('app.url'))->writeToFile(public_path('sitemap.xml'));

        Notification::make()
            ->title('Sitemap Generated Success')
            ->success()
            ->send();
    }
}
