<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BezhanSalleh\FilamentShield\Support\Utils;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["view_::App\\Models\\Menu","view_any_::App\\Models\\Menu","create_::App\\Models\\Menu","update_::App\\Models\\Menu","restore_::App\\Models\\Menu","restore_any_::App\\Models\\Menu","replicate_::App\\Models\\Menu","reorder_::App\\Models\\Menu","delete_::App\\Models\\Menu","delete_any_::App\\Models\\Menu","force_delete_::App\\Models\\Menu","force_delete_any_::App\\Models\\Menu","view_::App\\Models\\User","view_any_::App\\Models\\User","create_::App\\Models\\User","update_::App\\Models\\User","restore_::App\\Models\\User","restore_any_::App\\Models\\User","replicate_::App\\Models\\User","reorder_::App\\Models\\User","delete_::App\\Models\\User","delete_any_::App\\Models\\User","force_delete_::App\\Models\\User","force_delete_any_::App\\Models\\User","view_::Awcodes\\Curator\\Models\\Media","view_any_::Awcodes\\Curator\\Models\\Media","create_::Awcodes\\Curator\\Models\\Media","update_::Awcodes\\Curator\\Models\\Media","restore_::Awcodes\\Curator\\Models\\Media","restore_any_::Awcodes\\Curator\\Models\\Media","replicate_::Awcodes\\Curator\\Models\\Media","reorder_::Awcodes\\Curator\\Models\\Media","delete_::Awcodes\\Curator\\Models\\Media","delete_any_::Awcodes\\Curator\\Models\\Media","force_delete_::Awcodes\\Curator\\Models\\Media","force_delete_any_::Awcodes\\Curator\\Models\\Media","view_::BezhanSalleh\\FilamentExceptions\\Models\\Exception","view_any_::BezhanSalleh\\FilamentExceptions\\Models\\Exception","create_::BezhanSalleh\\FilamentExceptions\\Models\\Exception","update_::BezhanSalleh\\FilamentExceptions\\Models\\Exception","restore_::BezhanSalleh\\FilamentExceptions\\Models\\Exception","restore_any_::BezhanSalleh\\FilamentExceptions\\Models\\Exception","replicate_::BezhanSalleh\\FilamentExceptions\\Models\\Exception","reorder_::BezhanSalleh\\FilamentExceptions\\Models\\Exception","delete_::BezhanSalleh\\FilamentExceptions\\Models\\Exception","delete_any_::BezhanSalleh\\FilamentExceptions\\Models\\Exception","force_delete_::BezhanSalleh\\FilamentExceptions\\Models\\Exception","force_delete_any_::BezhanSalleh\\FilamentExceptions\\Models\\Exception","view_::Croustibat\\FilamentJobsMonitor\\Models\\QueueMonitor","view_any_::Croustibat\\FilamentJobsMonitor\\Models\\QueueMonitor","create_::Croustibat\\FilamentJobsMonitor\\Models\\QueueMonitor","update_::Croustibat\\FilamentJobsMonitor\\Models\\QueueMonitor","restore_::Croustibat\\FilamentJobsMonitor\\Models\\QueueMonitor","restore_any_::Croustibat\\FilamentJobsMonitor\\Models\\QueueMonitor","replicate_::Croustibat\\FilamentJobsMonitor\\Models\\QueueMonitor","reorder_::Croustibat\\FilamentJobsMonitor\\Models\\QueueMonitor","delete_::Croustibat\\FilamentJobsMonitor\\Models\\QueueMonitor","delete_any_::Croustibat\\FilamentJobsMonitor\\Models\\QueueMonitor","force_delete_::Croustibat\\FilamentJobsMonitor\\Models\\QueueMonitor","force_delete_any_::Croustibat\\FilamentJobsMonitor\\Models\\QueueMonitor","view_::Kenepa\\ResourceLock\\Models\\ResourceLock","view_any_::Kenepa\\ResourceLock\\Models\\ResourceLock","create_::Kenepa\\ResourceLock\\Models\\ResourceLock","update_::Kenepa\\ResourceLock\\Models\\ResourceLock","restore_::Kenepa\\ResourceLock\\Models\\ResourceLock","restore_any_::Kenepa\\ResourceLock\\Models\\ResourceLock","replicate_::Kenepa\\ResourceLock\\Models\\ResourceLock","reorder_::Kenepa\\ResourceLock\\Models\\ResourceLock","delete_::Kenepa\\ResourceLock\\Models\\ResourceLock","delete_any_::Kenepa\\ResourceLock\\Models\\ResourceLock","force_delete_::Kenepa\\ResourceLock\\Models\\ResourceLock","force_delete_any_::Kenepa\\ResourceLock\\Models\\ResourceLock","view_::LaraZeus\\Bolt\\Models\\Category","view_any_::LaraZeus\\Bolt\\Models\\Category","create_::LaraZeus\\Bolt\\Models\\Category","update_::LaraZeus\\Bolt\\Models\\Category","restore_::LaraZeus\\Bolt\\Models\\Category","restore_any_::LaraZeus\\Bolt\\Models\\Category","replicate_::LaraZeus\\Bolt\\Models\\Category","reorder_::LaraZeus\\Bolt\\Models\\Category","delete_::LaraZeus\\Bolt\\Models\\Category","delete_any_::LaraZeus\\Bolt\\Models\\Category","force_delete_::LaraZeus\\Bolt\\Models\\Category","force_delete_any_::LaraZeus\\Bolt\\Models\\Category","view_::LaraZeus\\Bolt\\Models\\Collection","view_any_::LaraZeus\\Bolt\\Models\\Collection","create_::LaraZeus\\Bolt\\Models\\Collection","update_::LaraZeus\\Bolt\\Models\\Collection","restore_::LaraZeus\\Bolt\\Models\\Collection","restore_any_::LaraZeus\\Bolt\\Models\\Collection","replicate_::LaraZeus\\Bolt\\Models\\Collection","reorder_::LaraZeus\\Bolt\\Models\\Collection","delete_::LaraZeus\\Bolt\\Models\\Collection","delete_any_::LaraZeus\\Bolt\\Models\\Collection","force_delete_::LaraZeus\\Bolt\\Models\\Collection","force_delete_any_::LaraZeus\\Bolt\\Models\\Collection","view_::LaraZeus\\Bolt\\Models\\Form","view_any_::LaraZeus\\Bolt\\Models\\Form","create_::LaraZeus\\Bolt\\Models\\Form","update_::LaraZeus\\Bolt\\Models\\Form","restore_::LaraZeus\\Bolt\\Models\\Form","restore_any_::LaraZeus\\Bolt\\Models\\Form","replicate_::LaraZeus\\Bolt\\Models\\Form","reorder_::LaraZeus\\Bolt\\Models\\Form","delete_::LaraZeus\\Bolt\\Models\\Form","delete_any_::LaraZeus\\Bolt\\Models\\Form","force_delete_::LaraZeus\\Bolt\\Models\\Form","force_delete_any_::LaraZeus\\Bolt\\Models\\Form","view_::MattDaneshvar\\Survey\\Models\\Answer","view_any_::MattDaneshvar\\Survey\\Models\\Answer","create_::MattDaneshvar\\Survey\\Models\\Answer","update_::MattDaneshvar\\Survey\\Models\\Answer","restore_::MattDaneshvar\\Survey\\Models\\Answer","restore_any_::MattDaneshvar\\Survey\\Models\\Answer","replicate_::MattDaneshvar\\Survey\\Models\\Answer","reorder_::MattDaneshvar\\Survey\\Models\\Answer","delete_::MattDaneshvar\\Survey\\Models\\Answer","delete_any_::MattDaneshvar\\Survey\\Models\\Answer","force_delete_::MattDaneshvar\\Survey\\Models\\Answer","force_delete_any_::MattDaneshvar\\Survey\\Models\\Answer","view_::MattDaneshvar\\Survey\\Models\\Entry","view_any_::MattDaneshvar\\Survey\\Models\\Entry","create_::MattDaneshvar\\Survey\\Models\\Entry","update_::MattDaneshvar\\Survey\\Models\\Entry","restore_::MattDaneshvar\\Survey\\Models\\Entry","restore_any_::MattDaneshvar\\Survey\\Models\\Entry","replicate_::MattDaneshvar\\Survey\\Models\\Entry","reorder_::MattDaneshvar\\Survey\\Models\\Entry","delete_::MattDaneshvar\\Survey\\Models\\Entry","delete_any_::MattDaneshvar\\Survey\\Models\\Entry","force_delete_::MattDaneshvar\\Survey\\Models\\Entry","force_delete_any_::MattDaneshvar\\Survey\\Models\\Entry","view_::MattDaneshvar\\Survey\\Models\\Question","view_any_::MattDaneshvar\\Survey\\Models\\Question","create_::MattDaneshvar\\Survey\\Models\\Question","update_::MattDaneshvar\\Survey\\Models\\Question","restore_::MattDaneshvar\\Survey\\Models\\Question","restore_any_::MattDaneshvar\\Survey\\Models\\Question","replicate_::MattDaneshvar\\Survey\\Models\\Question","reorder_::MattDaneshvar\\Survey\\Models\\Question","delete_::MattDaneshvar\\Survey\\Models\\Question","delete_any_::MattDaneshvar\\Survey\\Models\\Question","force_delete_::MattDaneshvar\\Survey\\Models\\Question","force_delete_any_::MattDaneshvar\\Survey\\Models\\Question","view_::MattDaneshvar\\Survey\\Models\\Section","view_any_::MattDaneshvar\\Survey\\Models\\Section","create_::MattDaneshvar\\Survey\\Models\\Section","update_::MattDaneshvar\\Survey\\Models\\Section","restore_::MattDaneshvar\\Survey\\Models\\Section","restore_any_::MattDaneshvar\\Survey\\Models\\Section","replicate_::MattDaneshvar\\Survey\\Models\\Section","reorder_::MattDaneshvar\\Survey\\Models\\Section","delete_::MattDaneshvar\\Survey\\Models\\Section","delete_any_::MattDaneshvar\\Survey\\Models\\Section","force_delete_::MattDaneshvar\\Survey\\Models\\Section","force_delete_any_::MattDaneshvar\\Survey\\Models\\Section","view_::MattDaneshvar\\Survey\\Models\\Survey","view_any_::MattDaneshvar\\Survey\\Models\\Survey","create_::MattDaneshvar\\Survey\\Models\\Survey","update_::MattDaneshvar\\Survey\\Models\\Survey","restore_::MattDaneshvar\\Survey\\Models\\Survey","restore_any_::MattDaneshvar\\Survey\\Models\\Survey","replicate_::MattDaneshvar\\Survey\\Models\\Survey","reorder_::MattDaneshvar\\Survey\\Models\\Survey","delete_::MattDaneshvar\\Survey\\Models\\Survey","delete_any_::MattDaneshvar\\Survey\\Models\\Survey","force_delete_::MattDaneshvar\\Survey\\Models\\Survey","force_delete_any_::MattDaneshvar\\Survey\\Models\\Survey","view_::Rappasoft\\LaravelAuthenticationLog\\Models\\AuthenticationLog","view_any_::Rappasoft\\LaravelAuthenticationLog\\Models\\AuthenticationLog","create_::Rappasoft\\LaravelAuthenticationLog\\Models\\AuthenticationLog","update_::Rappasoft\\LaravelAuthenticationLog\\Models\\AuthenticationLog","restore_::Rappasoft\\LaravelAuthenticationLog\\Models\\AuthenticationLog","restore_any_::Rappasoft\\LaravelAuthenticationLog\\Models\\AuthenticationLog","replicate_::Rappasoft\\LaravelAuthenticationLog\\Models\\AuthenticationLog","reorder_::Rappasoft\\LaravelAuthenticationLog\\Models\\AuthenticationLog","delete_::Rappasoft\\LaravelAuthenticationLog\\Models\\AuthenticationLog","delete_any_::Rappasoft\\LaravelAuthenticationLog\\Models\\AuthenticationLog","force_delete_::Rappasoft\\LaravelAuthenticationLog\\Models\\AuthenticationLog","force_delete_any_::Rappasoft\\LaravelAuthenticationLog\\Models\\AuthenticationLog","view_::RickDBCN\\FilamentEmail\\Models\\Email","view_any_::RickDBCN\\FilamentEmail\\Models\\Email","create_::RickDBCN\\FilamentEmail\\Models\\Email","update_::RickDBCN\\FilamentEmail\\Models\\Email","restore_::RickDBCN\\FilamentEmail\\Models\\Email","restore_any_::RickDBCN\\FilamentEmail\\Models\\Email","replicate_::RickDBCN\\FilamentEmail\\Models\\Email","reorder_::RickDBCN\\FilamentEmail\\Models\\Email","delete_::RickDBCN\\FilamentEmail\\Models\\Email","delete_any_::RickDBCN\\FilamentEmail\\Models\\Email","force_delete_::RickDBCN\\FilamentEmail\\Models\\Email","force_delete_any_::RickDBCN\\FilamentEmail\\Models\\Email","view_::SolutionForest\\FilamentFirewall\\Models\\Ip","view_any_::SolutionForest\\FilamentFirewall\\Models\\Ip","create_::SolutionForest\\FilamentFirewall\\Models\\Ip","update_::SolutionForest\\FilamentFirewall\\Models\\Ip","restore_::SolutionForest\\FilamentFirewall\\Models\\Ip","restore_any_::SolutionForest\\FilamentFirewall\\Models\\Ip","replicate_::SolutionForest\\FilamentFirewall\\Models\\Ip","reorder_::SolutionForest\\FilamentFirewall\\Models\\Ip","delete_::SolutionForest\\FilamentFirewall\\Models\\Ip","delete_any_::SolutionForest\\FilamentFirewall\\Models\\Ip","force_delete_::SolutionForest\\FilamentFirewall\\Models\\Ip","force_delete_any_::SolutionForest\\FilamentFirewall\\Models\\Ip","view_::Spatie\\Permission\\Models\\Role","view_any_::Spatie\\Permission\\Models\\Role","create_::Spatie\\Permission\\Models\\Role","update_::Spatie\\Permission\\Models\\Role","delete_::Spatie\\Permission\\Models\\Role","delete_any_::Spatie\\Permission\\Models\\Role","page_SiteSettings","page_Themes","page_MyProfilePage","page_Logs","page_Backups","page_HealthCheckResults","widget_OverlookWidget"]},{"name":"panel_user","guard_name":"web","permissions":[]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions, true))) {
            /** @var Model $roleModel */
            $roleModel = Utils::getRoleModel();
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = $roleModel::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (! blank($rolePlusPermission['permissions'])) {
                    $permissionModels = collect($rolePlusPermission['permissions'])
                        ->map(fn ($permission) => $permissionModel::firstOrCreate([
                            'name' => $permission,
                            'guard_name' => $rolePlusPermission['guard_name'],
                        ]))
                        ->all();

                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions, true))) {
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($permissions as $permission) {
                if ($permissionModel::whereName($permission)->doesntExist()) {
                    $permissionModel::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
