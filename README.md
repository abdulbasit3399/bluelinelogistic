# Algoriza Framework

Algoriza Framework Description.

## Installation


### Clone Repository
```bash
git clone https://github.com/ourcoteam/fr.git
```

### Move to the newly created directory
```bash
cd fr
```

### Create a new .env
```bash
cp .env.example .env
```

`Now edit your .env file and set your env parameters (Specially the database username/pass, database name)`

## Install the dependencies backend


### Install packages
```bash
composer install
```
- If found "contain a compatible set of packages" problems use the following command
```bash
composer install --ignore-platform-reqs
```

-----

## Install app with one command
```bash
php artisan app:install
```

## Run Application

### Run server
```bash
php artisan serve
```

### Run Mix to build assets
```bash
npm install
```

#### Development mode
```bash
npm run dev
```

#### Watch Development mode
```bash
npm run watch
```

### Open admin cms:

[http://localhost:8000/admin](http://localhost:8000/admin)

-----

## Manage permissions
`See Modules\Acl\Database\Seeders\SeedAllPermissionsTableSeeder.php`
### Add new permissions
- Go to `Modules/{moudle_name}/Config/config.php`
- Add new array with name ***permissions***
- Add new group in ***permissions*** array
- Example:

```php 
   return [
      'permissions' => [
          'posts' => [ // group name
              'view-posts', // permission name
              'read-posts', // permission name
          ]
      ]
   ];
```

### After added your permissions run this command to seed permissions in database
```bash
php artisan permissions:sync
```

-----

## Manage Languages
Description:
- Add Multi Languages
- Manage Translation words using database

### Add new language
- Go to `Modules/Localization/Config/config.php`
- Add new language inside array with key name ***languages***
- Example:
```php 
   return [
        'languages' => [
            'en' => [
                'name' => 'English',
                // 'dir' => 'ltr', // default ltr
                'is_default' => true // default false
            ],
            'ar' => [
                'name' => 'اللغة العربية',
                'dir' => 'rtl', // default ltr,
                // 'is_default' => false // default false
            ],
        ]
   ];
```

> Note:
> - You must add at least one language, and give it `is_default => true`.

### After added your languages `run the following command` to seed languages in database
```bash
php artisan languages:seed
```

#### To more manage localization
`See Modules\Localization\README.md`

------

## Manage General Setting
`See Modules\Setting\README.md`

-----

## How to add new module
We using Laravel modules [https://nwidart.com/laravel-modules/v6/introduction](https://nwidart.com/laravel-modules/v6/introduction)
```php
    php artisan module:make {module_name}
```

-----

## Manage Theme Setting
`See Modules\Setting\Theme_Setting_README.md`

-----

## Manage themes for frontend

### Make new theme
```bash
php artisan make:theme
```
<img src="https://i.imgur.com/cAwLppV.png" alt="Create theme" />

`This command will ask you to enter theme name, CSS framework, js framework, and optional auth scaffolding.`

### Useful Theme methods

```php

use Qirolab\Theme\Theme;

// Set active theme
Theme::set('theme-name');

// Get current active theme
Theme::active();

// Get current parent theme
Theme::parent();

// Clear theme. So, no theme will be active
Theme::clear();

// Get theme path
Theme::path($path = 'views');
// output:
// /app-root-path/themes/active-theme/views

Theme::path($path = 'views', $themeName = 'admin');
// output:
// /app-root-path/themes/admin/views

Theme::getViewPaths();
// Output:
// [
//     '/app-root-path/themes/admin/views',
//     '/app-root-path/resources/views'
// ]

```

### Middleware to set a theme
Register `ThemeMiddleware` in `app\Http\Kernel.php`:

```php
protected $routeMiddleware = [
    // ...
    'theme' => \Qirolab\Theme\Middleware\ThemeMiddleware::class,
];
```
Examples for middleware usage:
```php
// Example 1: set theme for a route
Route::get('/dashboard', 'DashboardController@index')
    ->middleware('theme:dashboard-theme');


// Example 2: set theme for a route-group
Route::group(['middleware'=>'theme:admin-theme'], function() {
    // "admin-theme" will be applied to all routes defined here
});


// Example 3: set child and parent theme
Route::get('/dashboard', 'DashboardController@index')
    ->middleware('theme:child-theme,parent-theme');
```

### Asset compilation
To compile the theme assets, you need to run this command:
```bash
npm run dev --theme=theme-name

# or

npm run watch --theme=theme-name

# or

npm run production --theme=theme-name
```

We using this package: [Laravel themer](https://github.com/qirolab/laravel-themer) to more info.

### Manage Theme config

To add config in your theme and use it from by laravel function -> `config()`:
- Add new folder with name `config` in root theme
- And add `config.php` file in this folder  
- Example: `themes/{theme_name}/config/config.php`
- Now you able to use this by laravel config function
- Type prefix "theme_" before theme name
- Using Example: 
```php
   config('theme_{theme_name}.key');
```


### Manage Theme localization

To add words translations in your theme and use it from by laravel function -> `__()`, `trans()` or `@lang()`:
- Add new folder with name `lang` in root theme
- And add folder your language in this folder [en, ar]
- Example: `themes/{theme_name}/lang/en`
- And add your file in the folder `en`
- Now you able to use this by laravel trans function
- Type prefix "theme_" before theme name
- Using Example: 

- Add file with name view.php
- themes/{theme_name}/lang/en/view.php
```php
    // view.php file
    return [
        'name' => 'Name'
    ];
   __('theme_{theme_name}::view.name');
```



### Manage aside menu with your module localization

To add menu items from your module, you will have to use the hooks functionality
- Type this code in: `Modules\{your_module}\Providers\{your_module}ServiceProvider` @boot function
```php
    $aside_menu = view('{your_module}::components.aside_menu');
    $aside_menu['order'] = 8; //The item order on the menu
    app('hook')->set('aside_menu', $aside_menu, 'array');
```
- In the `aside_menu` view add your code to include it like the following
```php
    @can('view-{your_module}')
        <div class="menu-item">
            <a class="menu-link {{ active_route('{your_module}.index') }}" href="{{ fr_route('{your_module}.index') }}">
                <span class="menu-icon">
                    <i class="fas fa-box fa-fw"></i>
                </span>
                <span class="menu-title">{{ __('widget::view.{your_module}') }}</span>
            </a>
        </div>
    @endcan
```

-------



## How to use global hook? 

Global hook support to type: object, array.
type object is default

Type array Example:
This example to add component from blog module to menu module:
Type this code in: Modules\Blog\Providers\BlogServiceProvider @boot

```php
    $select_category_menu_components = view('blog::components.select_category_to_menu');
    $select_post_menu_components = view('blog::components.select_post_to_menu');
    app('hook')->set('menu_addables', $select_category_menu_components, 'array');
    app('hook')->set('menu_addables', $select_post_menu_components, 'array');
```

Use hook in menu module -> in blade file, or controller:

```php
    // in blade file
    @if (app('hook')->get('menu_addables'))
        @foreach(app('hook')->get('menu_addables') as $componentView)
            {!! $componentView !!}
        @endforeach
    @endif
```
-----
Type object Example:
Add this code in provider
```php
    $select_branch_component = // view(), html, text, json,... or any data
    app('hook')->set('select_branch', $select_branch_component);
```
Use hook to any module in views, controller or any place in code
```php    
    echo app('hook')->get('select_branch');
```

-----

## Manage Widgets
`See Modules\Widget\README.md`

## Manage Sidebars
`See Modules\Widget\Sidebar.md`

-----