<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;
use Illuminate\Support\Facades\File;

class UpdateNotificationsSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('notifications.email', false);
        $this->migrator->add('notifications.sms', false);
        $this->migrator->add('notifications.fcm', false);

        //FIX
        // $all_modules = array_map('basename', File::directories(base_path('Modules')) );

        // foreach ($all_modules as $module_name) {
        //     $module_name = strtolower($module_name);
        //     if(check_module($module_name)){
        //         $setting_module = config("$module_name.module_setting");

        //         if($setting_module){
        //             foreach ($setting_module as $module_slug => $module) {
        //                 $active = array_key_exists('active', $module) && $module['active'] === true;
        //                 if ($active && isset($module['notifications'])) {
        //                     $fields = $module['notifications'];
                            
        //                     foreach ($fields as $key => $options) {
        //                         $this->migrator->add($module_name.'.'.$key, $options['value']);
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }
    }
}
