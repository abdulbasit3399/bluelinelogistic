<?php

namespace Modules\Blog\Providers;

use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Blog';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'blog';

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

        $aside_menu = view('blog::'.$adminTheme.'.components.aside_menu');
        $aside_menu['order'] = 1;
        app('hook')->set('aside_menu', $aside_menu, 'array');

        $aside_menu_settings = view('blog::'.$adminTheme.'.components.aside_menu_settings');
        app('hook')->set('aside_menu_settings', $aside_menu_settings, 'array');

        $select_category_menu_components = view('blog::'.$adminTheme.'.components.select_category_to_menu');
        $select_post_menu_components = view('blog::'.$adminTheme.'.components.select_post_to_menu');
        
        app('hook')->set('menu_addables', $select_category_menu_components, 'array');
        app('hook')->set('menu_addables', $select_post_menu_components, 'array');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        // Categories
        $this->app['events']->listen(\Modules\Blog\Events\CategoryCreatedEvent::class, \Modules\Blog\Listeners\CategoryCreatedListener::class);
        $this->app['events']->listen(\Modules\Blog\Events\CategoryUpdatedEvent::class, \Modules\Blog\Listeners\CategoryUpdatedListener::class);
        $this->app['events']->listen(\Modules\Blog\Events\CategoryDeletedEvent::class, \Modules\Blog\Listeners\CategoryDeletedListener::class);

        // Comments
        $this->app['events']->listen(\Modules\Blog\Events\CommentApprovedEvent::class, \Modules\Blog\Listeners\CommentApprovedListener::class);
        $this->app['events']->listen(\Modules\Blog\Events\CommentCreatedEvent::class, \Modules\Blog\Listeners\CommentCreatedListener::class);
        $this->app['events']->listen(\Modules\Blog\Events\CommentUpdatedEvent::class, \Modules\Blog\Listeners\CommentUpdatedListener::class);
        $this->app['events']->listen(\Modules\Blog\Events\CommentDeletedEvent::class, \Modules\Blog\Listeners\CommentDeletedListener::class);

        // Posts
        $this->app['events']->listen(\Modules\Blog\Events\PostCreatedEvent::class, \Modules\Blog\Listeners\PostCreatedListener::class);
        $this->app['events']->listen(\Modules\Blog\Events\PostUpdatedEvent::class, \Modules\Blog\Listeners\PostUpdatedListener::class);
        $this->app['events']->listen(\Modules\Blog\Events\PostDeletedEvent::class, \Modules\Blog\Listeners\PostDeletedListener::class);

        // Tags
        $this->app['events']->listen(\Modules\Blog\Events\TagCreatedEvent::class, \Modules\Blog\Listeners\TagCreatedListener::class);
        $this->app['events']->listen(\Modules\Blog\Events\TagUpdatedEvent::class, \Modules\Blog\Listeners\TagUpdatedListener::class);
        $this->app['events']->listen(\Modules\Blog\Events\TagDeletedEvent::class, \Modules\Blog\Listeners\TagDeletedListener::class);

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
