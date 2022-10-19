<?php

namespace Modules\Setting\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Modules\Setting\Entities\Setting;
use Illuminate\Support\Str;
use Modules\Acl\Entities\PermissionGroup;
use Spatie\Permission\Models\Permission;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $setting_modules = [];
        $setting_module_permissions = [];
        $all_modules = array_map('basename', File::directories(base_path('Modules')) );

        foreach ($all_modules as $module_name) {
            $module_name = strtolower($module_name);
            $setting_module = config("$module_name.module_setting");
            if ($setting_module) {
                $setting_modules = array_merge($setting_modules, $setting_module);
            }
        }

        foreach ($setting_modules as $module_slug => $module) {
            $setting_module_exists = Setting::where('module_slug', $module_slug)->withTrashed()->first();
            $parent = array_key_exists('parent', $module) ? $module['parent'] : null;
            $active = array_key_exists('active', $module) && $module['active'] === true;
            $groups = array_key_exists('groups', $module) && is_array($module['groups']) ? $module['groups'] : [];
            if ($setting_module_exists) {
                $fields = $this->checkOnChanges($setting_module_exists->fields, $module['fields']);
                $fields = $this->handleDefaultValue($fields);
                $setting_for_update = [
                    'parent' => $parent,
                    'module_name' => $module['name'],
                    'groups' => $groups,
                    'fields' => $fields,
                ];
                $setting_module_exists->update($setting_for_update);
                if ($active) {
                    $setting_module_exists->restore();
                } else {
                    $setting_module_exists->delete();
                }
            } else {
                // check on setting group
                $settingGroup = PermissionGroup::where('name', 'setting')->first();
                if (!$settingGroup) {
                    $this->command->getOutput()->writeln("<error>Seeding setting:</error> Permission group (setting) is not exists, please add setting permission group in permissions key in 'Modules/Setting/Config/config.php' and make this command: php artisan db:seed, then try this command again.");
                    dd();
                }
                $permission_name = 'manage-' . Str::replace('_', '-', trim(Str::kebab($module_slug), '_-'));
                $permission = Permission::firstOrCreate(
                    ['name' => $permission_name],
                    ['permission_group_id' => $settingGroup->id]
                );
                $setting_module_permissions[] = $permission_name;
                $setting_for_create = [
                    'parent' => $parent,
                    'module_name' => $module['name'],
                    'module_slug' => $module_slug,
                    'permission_id' => $permission->id,
                    'groups' => $groups,
                    'fields' => $this->handleDefaultValue($module['fields'])
                ];
                $setting_created = Setting::create($setting_for_create);
                if (!$active) {
                    $setting_created->delete();
                }
            }
        }
        
        $demoUser = User::find(1);
        if ($demoUser) {
            $demoUser->givePermissionTo($setting_module_permissions);
        }
    }

    /**
     * Handle default values.
     *
     * @return array
     */
    private function handleDefaultValue($fields)
    {
        $fields = $this->filterFields($fields);
        $allow_setting_types = config('setting.allow_setting_types');
        return collect($fields)->map(function ($field, $key) use ($allow_setting_types) {
            $value = null;
            $type = $field['type'];
            $group_id = array_key_exists('group_id', $field) ? $field['group_id'] : null;
            if (!in_array($type, $allow_setting_types)) {
                $this->command->getOutput()->writeln("<error>Seeding setting:</error> Type: $type is not allow.");
                dd();
            }
            if ($type == 'boolean') { // default = false
                $value = isset($field['value']) && $field['value'] === true ? true : false;
            } else if ($type == 'array') { // default = []
                $value = isset($field['value']) && !is_array($field['value']) ? [] : $field['value'];
            } else { // default = ''
                $value = isset($field['value']) && $field['value'] != '' ? $field['value'] : '';
            }
            return [
                'name' => $field['name'],
                'type' => $type,
                'group_id' => $group_id,
                'value' => $value,
                'validation' => isset($field['validation']) && $field['validation'] ? $field['validation'] : [],
            ];
        });
    }


    /**
     * Handle change types.
     *
     * @return array
     */
    private function checkOnChanges($db_fields, $seeder_fields)
    {
        $fields = [];
        $seeder_fields = $this->filterFields($seeder_fields);
        foreach ($seeder_fields as $key_seeder_field => $seeder_field)
        {
            $db_field = collect($db_fields)->first(function ($item, $key) use ($key_seeder_field) {
                return $key == $key_seeder_field;
            });
            $type_changed = $db_field ? ($db_field['type'] != $seeder_field['type']) : false;
            $group_id = array_key_exists('group_id', $seeder_field) ? $seeder_field['group_id'] : null;
            $fields[$key_seeder_field] = [
                'name' => $seeder_field['name'],
                'type' => $seeder_field['type'],
                'group_id' => $group_id,
                'validation' => isset($seeder_field['validation']) ? $seeder_field['validation'] : '',
                'value' => $type_changed ? $seeder_field['value'] : ($db_field ? $db_field['value'] : $seeder_field['value'])
            ];
        }
        return $fields;
    }



    /**
     * Filter fields.
     *
     * @return array
     */
    private function filterFields($fields)
    {
        return collect($fields)->filter(function ($field) {
            return (isset($field['active']) && $field['active'] != false) || !isset($field['active']);
        });
    }

}
