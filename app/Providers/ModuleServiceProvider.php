<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(env('INSTALLATION', false) == true){
            $this->registerConfig();
        }
    }


    protected function registerConfig()
    {
        $modules = array_map('basename', File::directories(base_path('Modules')) );
        foreach ($modules as $module) {
            $moduleNameLower = strtolower($module);
            $config_path = base_path("Modules/{$module}/Config/config.php");
            $config_exists = file_exists($config_path);
            if ($config_exists) {
                $this->publishes([
                    $config_path => config_path("module_{$moduleNameLower}.php"),
                ], 'config');
                $this->mergeConfigFrom(
                    $config_path, "module_{$moduleNameLower}"
                );
            }
        }
    }

}
