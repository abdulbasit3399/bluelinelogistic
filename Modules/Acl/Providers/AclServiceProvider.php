<?php

namespace Modules\Acl\Providers;

use Illuminate\Support\ServiceProvider;

class AclServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Acl';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'acl';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));

        // unregister_sidebar('sidebar_user', 'html');

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        $aside_menu = view('acl::'.$adminTheme.'.components.aside_menu');
        $aside_menu['order'] = 11;
        app('hook')->set('aside_menu', $aside_menu, 'array');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        
        $this->app['events']->listen(\Modules\Acl\Events\PermissionCreatedEvent::class, \Modules\Acl\Listeners\PermissionCreatedListener::class);
        $this->app['events']->listen(\Modules\Acl\Events\RoleCreatedEvent::class, \Modules\Acl\Listeners\RoleCreatedListener::class);
        $this->app['events']->listen(\Modules\Acl\Events\RoleUpdatedEvent::class, \Modules\Acl\Listeners\RoleUpdatedListener::class);
        $this->app['events']->listen(\Modules\Acl\Events\RoleDeletedEvent::class, \Modules\Acl\Listeners\RoleDeletedListener::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
