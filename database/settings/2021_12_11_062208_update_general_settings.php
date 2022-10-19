<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;
use Illuminate\Support\Facades\File;

class UpdateGeneralSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.current_version', '6.4');
        $this->migrator->add('general.company_name', 'Spotlayer');
        $this->migrator->add('general.website_title', 'Spotlayer');
        $this->migrator->add('general.website_description', '');
        $this->migrator->add('general.website_keywords', '');
        $this->migrator->add('general.system_logo', '');
        $this->migrator->add('general.loading_logo', '');
        $this->migrator->add('general.login_page_logo', '');
        $this->migrator->add('general.website_logo', '');
        $this->migrator->add('general.social_image', '');
        $this->migrator->add('general.maintenance_mode', false);
        $this->migrator->add('general.timezone', 'Africa/Cairo');
        $this->migrator->add('general.active_theme', 'easyship');


        $all_modules = array_map('basename', File::directories(base_path('Modules')) );
        foreach ($all_modules as $module_name) {
            $module_name = strtolower($module_name);
            if(check_module($module_name)){
                $payments = config("$module_name.payments");
                if($payments){
                    foreach ($payments as $key => $options) {
                        if(isset($options['migrate']) && $options['migrate'])
                            $this->migrator->add('payments.'.$key, $options['value']);
                    }
                }
                $notifications = config("$module_name.notifications");
                if($notifications){
                    foreach ($notifications as $key => $options) {
                        if(isset($options['migrate']) && $options['migrate'])
                            $this->migrator->add('notifications.'.$key, $options['value']);
                    }
                }
                $module_setting = config("$module_name.module_setting");
                if($module_setting){
                    $module_setting = $module_setting[$module_name.'_setting'];
                    if(isset($module_setting['fields']) && $module_setting['active']) {
                        foreach ($module_setting['fields'] as $key => $options) {
                            $this->migrator->add($module_name.'.'.$key, $options['value']);
                        }
                    }
                }
            }
        }
    }
}
