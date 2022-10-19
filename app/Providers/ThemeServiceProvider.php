<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Qirolab\Theme\Theme;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(env('INSTALLATION', false) == true){
            $active_theme = preg_replace('/[^A-Za-z0-9\-]/', '', get_general_setting('active_theme')); // Removes special chars.
            Theme::set($active_theme);
        }
        $this->registerConfig();
    }

    protected function registerConfig()
    {
        if(env('INSTALLATION', false) == true){
            $themes = array_map('basename', File::directories(base_path('themes')) );
            foreach ($themes as $theme) {
                $themeNameLower = strtolower($theme);
                $config_path = base_path("themes/{$theme}/config/config.php");
                $config_exists = file_exists($config_path);
                if ($config_exists) {
                    $this->publishes([
                        $config_path => config_path("theme_{$themeNameLower}.php"),
                    ], 'config');
                    $this->mergeConfigFrom(
                        $config_path, "theme_{$themeNameLower}"
                    );
                }
            }
        
        
            if (\Illuminate\Support\Facades\Schema::hasTable('theme_setting_containers')) {
                if(config_theme('sidebars')) {
                    foreach(config_theme('sidebars') as $sidebar){
                        register_sidebar([
                            'id' => $sidebar['id'],
                            'name' => $sidebar['name'],
                            'theme' => $sidebar['theme'] ?? strtolower(\Qirolab\Theme\Theme::active()),
                            'description' => $sidebar['description'],
                            'before_sidebar' => $sidebar['before_sidebar'],
                            'after_sidebar'  => $sidebar['after_sidebar'],
                            'before_widget' => $sidebar['before_widget'],
                            'after_widget'  => $sidebar['after_widget']
                        ]);
                    }
                }
            }
        }
    }

}
