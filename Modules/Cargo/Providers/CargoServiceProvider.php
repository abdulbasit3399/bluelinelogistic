<?php

namespace Modules\Cargo\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class CargoServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Cargo';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'cargo';

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

        $adminTheme = env('ADMIN_THEME', 'adminLte');

        $aside_menu = view('cargo::'.$adminTheme.'.components.aside_menu');
        $aside_menu['order'] = 12;
        app('hook')->set('aside_menu', $aside_menu, 'array');

        $aside_menu_settings = view('cargo::'.$adminTheme.'.components.aside_menu_settings');
        app('hook')->set('aside_menu_settings', $aside_menu_settings, 'array');

        $end_user_form = view('cargo::'.$adminTheme.'.components.end_user_form');
        app('hook')->set('end_user_form', $end_user_form, 'array');

        $dashboard_count = view('cargo::'.$adminTheme.'.components.dashboard_count');
        app('hook')->set('dashboard_count', $dashboard_count, 'array');

        $dashboard_latest_list = view('cargo::'.$adminTheme.'.components.dashboard_latest_list');
        app('hook')->set('dashboard_latest_list', $dashboard_latest_list, 'array');

        $aside_menu_reports = view('cargo::'.$adminTheme.'.components.aside_menu_reports');
        app('hook')->set('aside_menu_reports', $aside_menu_reports, 'array');

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);


        $this->app['events']->listen(\Modules\Users\Events\UserCreatedEvent::class, \Modules\Cargo\Listeners\UserCreatedListener::class);
        $this->app['events']->listen(\App\Events\NotificationSettingsUpdated::class, \Modules\Cargo\Listeners\NotificationSettingsUpdatedListener::class);

        $this->app['events']->listen(\Modules\Cargo\Events\AddDriver::class, \Modules\Cargo\Listeners\SendDriverNotification::class);
        $this->app['events']->listen(\Modules\Cargo\Events\AddClient::class, \Modules\Cargo\Listeners\SendClientNotification::class);
        $this->app['events']->listen(\Modules\Cargo\Events\AddShipment::class, \Modules\Cargo\Listeners\SendAddShipmenttNotification::class);

        $this->app['events']->listen(\Modules\Cargo\Events\AssignMission::class, \Modules\Cargo\Listeners\SendAssignMissionNotification::class);
        $this->app['events']->listen(\Modules\Cargo\Events\ApproveMission::class, \Modules\Cargo\Listeners\SendApproveMissionNotification::class);

        $this->app['events']->listen(\Modules\Cargo\Events\CreateMission::class, \Modules\Cargo\Listeners\SendCreateMissionNotification::class);
        $this->app['events']->listen(\Modules\Cargo\Events\ShipmentAction::class, \Modules\Cargo\Listeners\SendShipmentActionNotification::class);

        $this->app['events']->listen(\Modules\Cargo\Events\MissionAction::class, \Modules\Cargo\Listeners\SendMissionActionNotification::class);

        $this->app['events']->listen(\Modules\Cargo\Events\UpdateMission::class, \Modules\Cargo\Listeners\SendUpdateMissionNotification::class);
        $this->app['events']->listen(\Modules\Cargo\Events\UpdateShipment::class, \Modules\Cargo\Listeners\SendUpdateShipmentNotification::class);
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
