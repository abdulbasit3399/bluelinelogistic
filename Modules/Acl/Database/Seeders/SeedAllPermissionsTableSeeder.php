<?php

namespace Modules\Acl\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Acl\Entities\PermissionGroup;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Modules\Acl\Events\PermissionCreatedEvent;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SeedAllPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // remove all permissions | use this for reset all permissions or roles only.
        // Permission::query()->delete();
        // PermissionGroup::query()->delete();

        // clear config, view, cache, and route;
        Artisan::call('refresh:cache');

        // Get permissions from all modules
        $all_modules = array_map('basename', File::directories(base_path('Modules')) );
        $permission_groups = [];
        $all_permissions = [];
        $setting_module_permissions = [];
        $setting_modules = [];

        $permission_groups = config("permissions.permissions");

        foreach ($all_modules as $module_name) {
            $module_name = strtolower($module_name);
            $permissions_config_module = config("$module_name.permissions");
            if ($permissions_config_module) {
                $permission_groups = array_merge($permission_groups, $permissions_config_module);
            }

            $setting_module = config("$module_name.module_setting");
            if ($setting_module) {
                $setting_modules = array_merge($setting_modules, array_keys($setting_module));
            }
        }
        // get all setting module permissions
        foreach ($setting_modules as $module_slug) {
            $permission_name = 'manage-' . Str::replace('_', '-', trim(Str::kebab($module_slug), '_-'));
            $setting_module_permissions[] = $permission_name;
        }


        // delete groups was removed from config
        $old_groups = PermissionGroup::all()->pluck('name');
        $diff_groups = $old_groups->diff(array_keys($permission_groups));
        PermissionGroup::whereIn('name', $diff_groups->toArray())->delete();

        // sync setting module permissions
        $permission_groups['setting'] = array_merge($permission_groups['setting'], $setting_module_permissions);

        foreach($permission_groups as $group => $permissions) {
            $all_permissions = array_merge($all_permissions, $permissions);
            $group_exists = PermissionGroup::where('name', $group)->first();

            if ($group_exists) {
                $group_id = $group_exists->id;
                $old_permissions = $group_exists->permissions->pluck('name');
                $diff_permissions = $old_permissions->diff($permissions);
                // delete permissions was removed from config
                Permission::whereIn('name', $diff_permissions->toArray())->delete();
            } else {
                $group_created = PermissionGroup::create(['name' => $group]);
                $group_id = $group_created->id;
            }

            foreach($permissions as $permission) {
                $permission_exists = Permission::where('name', $permission)->first();
                if (!$permission_exists) {
                    $permission_created = Permission::create([
                        'name' => $permission,
                        'guard_name' => 'web',
                        'permission_group_id' => $group_id
                    ]);
                    event(new PermissionCreatedEvent($permission_created));
                }
            }
        }
        $demoUser = User::find(1);
        if ($demoUser)
            $demoUser->givePermissionTo($all_permissions);
    }
}
