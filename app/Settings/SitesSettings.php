<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SitesSettings extends Settings
{
    public ?string $name;
    public ?string $description;
    public ?string $keywords;
    public ?string $light_logo;
    public ?string $dark_logo;
    public ?string $author;
    public ?string $address;
    public ?string $email;
    public ?string $phone;
    public ?string $timezone;
    public ?array $locales;
    public ?string $location;
    public ?string $currency;
    public ?array $social;

    public static function group(): string
    {
        return 'sites';
    }
}
