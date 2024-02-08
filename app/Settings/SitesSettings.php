<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SitesSettings extends Settings
{
    public ?string $name;
    public ?string $description;
    public ?string $light_logo;
    public ?string $dark_logo;
    public ?string $no_image;
    public ?string $author;
    public ?string $address;
    public ?string $email;
    public ?string $phone;
    public ?string $timezone;
    public ?array $locales = ['en'];
    public ?string $location;
    public ?string $currency;
    public ?array $social;
    public ?string $primary_color;
    public ?string $default_locale;

    public static function group(): string
    {
        return 'sites';
    }
}
