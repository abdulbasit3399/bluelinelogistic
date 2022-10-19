## Register new sidebar

Run function `register_sidebar` in `ServiceProvider` whether in module or root app
- in app = `app/Providers/AppServiceProvider @register`
- in module = `Modules/{module}/{module}ServiceProvider @register`
Register example: 

```php
public function register()
    {
        register_sidebar([
            'id' => 'sidebar_id',
            'name' => 'sidebar name',
            'theme' => 'html',
            'description' => 'sidebar description',
            'before_sidebar' => '<aside id="sidebar_id" class="sidebar-class">',
            'after_sidebar'  => '</aside>',
            'before_widget' => '<section class="widget">',
            'after_widget'  => '</section>'
        ]);
    }
```


## Unregister sidebar

Run function `unregister_sidebar` in `ServiceProvider` whether in module or root app
- in app = `app/Providers/AppServiceProvider @boot`
- in module = `Modules/{module}/{module}ServiceProvider @boot`
Unregister example: 

```php
public function boot()
    {
        unregister_sidebar('sidebar_id');
    }
```