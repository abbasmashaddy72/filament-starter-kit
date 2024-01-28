<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SitesSettings extends Settings
{
    public ?string $name;
    public ?string $description;
    public ?string $keywords;
    public ?string $profile;
    public ?string $logo;
    public ?string $author;
    public ?string $address;
    public ?string $email;
    public ?string $phone;
    public ?string $phone_code;
    public ?string $location;
    public ?string $currency;
    public ?string $language;
    public ?array $social;

    public static function group(): string
    {
        return 'sites';
    }
}
