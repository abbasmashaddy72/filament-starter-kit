<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        if (config('app.env') == 'production') {
            User::create([
                'name' => 'Super Admin',
                'email' => 'superadmin@cms.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
            User::find(1)->first()->assignRole('super_admin');
        } else {
            $users = User::factory()->count(rand(100, 300))->create();
            $superAdmin = $users->first();
            $superAdmin->update([
                'email' => 'superadmin@cms.com',
            ]);
            $superAdmin->assignRole('super_admin');
        }
    }
}
