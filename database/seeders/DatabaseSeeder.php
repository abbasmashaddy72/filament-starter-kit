<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
            // Run SQL from backup file
            $backupFilePath = database_path('media.sql');
            if (file_exists($backupFilePath)) {
                DB::unprepared(file_get_contents($backupFilePath));
            }
            // Add the shield:install --fresh command here
            exec('yes | php artisan shield:install --fresh');
            $this->call([
                MenuSeeder::class,
                ShieldSeeder::class,
                UserSeeder::class,
                FaqSeeder::class,
                PageSeeder::class,
                TopicSeeder::class,
                ArticleSeeder::class,
                PostSeeder::class,
            ]);
        }
    }
}
