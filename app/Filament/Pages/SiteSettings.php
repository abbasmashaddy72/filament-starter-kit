<?php

namespace App\Filament\Pages;

use Filament\Forms;
use App\Colors\Color;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Illuminate\Support\Arr;
use Filament\Actions\Action;
use App\Settings\SitesSettings;
use Filament\Pages\SettingsPage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Spatie\Sitemap\SitemapGenerator;
use Filament\Notifications\Notification;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;
use Tapp\FilamentTimezoneField\Forms\Components\TimezoneSelect;
use Parfaitementweb\FilamentCountryField\Forms\Components\Country;

class SiteSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = SitesSettings::class;

    protected static ?string $navigationGroup = 'CMS';

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
                            Forms\Components\FileUpload::make('dark_logo'),
                            Forms\Components\FileUpload::make('light_logo'),
                            TimezoneSelect::make('timezone')
                                ->searchable(),
                            Country::make('location')
                                ->searchable(),
                            Forms\Components\Select::make('currency')
                                ->searchable()
                                ->options(config('main.currencies')),
                            Forms\Components\Select::make('locales')->multiple()
                                ->options(config('main.locales'))->searchable(),
                            Forms\Components\Select::make('primary_color')
                                ->options($this->getColors())
                                ->allowHtml()
                                ->searchable(),
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
                                IconPicker::make('icon')
                                    ->sets(['remix'])
                                    ->columns([
                                        'default' => 1,
                                        'lg' => 3,
                                        '2xl' => 5,
                                    ]),
                                Forms\Components\TextInput::make('platform'),
                                Forms\Components\TextInput::make('link')->url(),
                            ])->grid([
                                'default' => 1,
                                'md' => 2,
                                'xl' => 3,
                                '2xl' => 3,
                            ]),
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

    public function getColors()
    {
        $colors = Arr::except(Color::all(), ['gray', 'zinc', 'neutral', 'stone']);
        $filteredColors = [];

        foreach ($colors as $colorName => $shades) {
            if (isset($shades[500])) {
                $filteredColors[ucfirst($colorName)] = "<div class=\"bg-{$colorName}-500 p-2 flex items-center w-full rounded-md\">" . ucfirst($colorName) . "</div>";
            }
        }

        return $filteredColors;
    }
}

// bg-slate-500
// bg-red-500
// bg-orange-500
// bg-amber-500
// bg-yellow-500
// bg-lime-500
// bg-green-500
// bg-emerald-500
// bg-teal-500
// bg-cyan-500
// bg-sky-500
// bg-blue-500
// bg-indigo-500
// bg-violet-500
// bg-purple-500
// bg-fuchsia-500
// bg-pink-500
// bg-rose-500
