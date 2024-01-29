<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (config('app.env') == 'production') {
            $this->call([
                ShieldSeeder::class,
                UserSeeder::class,
            ]);
        } else {
            // Add the shield:install --fresh command here
            exec('yes | php artisan shield:install --fresh');
            $this->call([
                ShieldSeeder::class,
                UserSeeder::class,
                MediaSeeder::class,
                FaqSeeder::class,
                PageSeeder::class,
                TopicSeeder::class,
                ArticleSeeder::class,
                PostSeeder::class,
            ]);
        }
    }
}
