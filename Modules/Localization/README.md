# Localization module

## Manage Languages
Description:
- Add Multi Languages
- Manage Translation words using database

### Add new language:
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

### Add new phrases
- Add your phrases in translation files to default language
- Then `run the following command` to added all phrases to database:

```bash
php artisan translations:sync
```

### force translations
Optional parameter which is used to automatically overwrite for all existing phrases in database
```bash
php artisan translations:sync --force
```

### clear cache for translations
```bash
php artisan translations:clear-cache
```

### The following command for save all translations in seeder file
```bash
php artisan translations:seed
```

### translation helpers

```php
    // in blade file:
    <div>
        @locale // => get current language code, example: "en"
        @dir // => get current language direction, example: "ltr"
        @localeName // => get current language name, example: "English"
    </div>

    // in php file:
    $locale     = get_locale('code'); // return example: "en"
    $dir        = get_locale('dir'); // return example: "ltr"
    $localeName = get_locale('name'); // return example: "English"
    $is_default = get_locale('is_default'); // return boolean
```

-----

## Manage Setting
`See Modules\Setting\README.md`

-----