<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('sites.primary_color', 'Blue');
        $this->migrator->add('sites.default_locale', 'en');
    }
};
