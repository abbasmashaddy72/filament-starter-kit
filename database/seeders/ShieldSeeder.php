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

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["view_","view_any_","create_","update_","restore_","restore_any_","replicate_","reorder_","delete_","delete_any_","force_delete_","force_delete_any_","view_answer","view_any_answer","create_answer","update_answer","restore_answer","restore_any_answer","replicate_answer","reorder_answer","delete_answer","delete_any_answer","force_delete_answer","force_delete_any_answer","view_authentication::log","view_any_authentication::log","create_authentication::log","update_authentication::log","restore_authentication::log","restore_any_authentication::log","replicate_authentication::log","reorder_authentication::log","delete_authentication::log","delete_any_authentication::log","force_delete_authentication::log","force_delete_any_authentication::log","view_category","view_any_category","create_category","update_category","restore_category","restore_any_category","replicate_category","reorder_category","delete_category","delete_any_category","force_delete_category","force_delete_any_category","view_collection","view_any_collection","create_collection","update_collection","restore_collection","restore_any_collection","replicate_collection","reorder_collection","delete_collection","delete_any_collection","force_delete_collection","force_delete_any_collection","view_email","view_any_email","create_email","update_email","restore_email","restore_any_email","replicate_email","reorder_email","delete_email","delete_any_email","force_delete_email","force_delete_any_email","view_entry","view_any_entry","create_entry","update_entry","restore_entry","restore_any_entry","replicate_entry","reorder_entry","delete_entry","delete_any_entry","force_delete_entry","force_delete_any_entry","view_exception","view_any_exception","create_exception","update_exception","restore_exception","restore_any_exception","replicate_exception","reorder_exception","delete_exception","delete_any_exception","force_delete_exception","force_delete_any_exception","view_firewall::ip","view_any_firewall::ip","create_firewall::ip","update_firewall::ip","restore_firewall::ip","restore_any_firewall::ip","replicate_firewall::ip","reorder_firewall::ip","delete_firewall::ip","delete_any_firewall::ip","force_delete_firewall::ip","force_delete_any_firewall::ip","view_form","view_any_form","create_form","update_form","restore_form","restore_any_form","replicate_form","reorder_form","delete_form","delete_any_form","force_delete_form","force_delete_any_form","view_media","view_any_media","create_media","update_media","restore_media","restore_any_media","replicate_media","reorder_media","delete_media","delete_any_media","force_delete_media","force_delete_any_media","view_question","view_any_question","create_question","update_question","restore_question","restore_any_question","replicate_question","reorder_question","delete_question","delete_any_question","force_delete_question","force_delete_any_question","view_queue::monitor","view_any_queue::monitor","create_queue::monitor","update_queue::monitor","restore_queue::monitor","restore_any_queue::monitor","replicate_queue::monitor","reorder_queue::monitor","delete_queue::monitor","delete_any_queue::monitor","force_delete_queue::monitor","force_delete_any_queue::monitor","view_role","view_any_role","create_role","update_role","delete_role","delete_any_role","view_section","view_any_section","create_section","update_section","restore_section","restore_any_section","replicate_section","reorder_section","delete_section","delete_any_section","force_delete_section","force_delete_any_section","view_survey","view_any_survey","create_survey","update_survey","restore_survey","restore_any_survey","replicate_survey","reorder_survey","delete_survey","delete_any_survey","force_delete_survey","force_delete_any_survey","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user","page_Themes","page_MyProfilePage","page_Logs","page_Backups","page_HealthCheckResults","widget_OverlookWidget"]}]';
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
