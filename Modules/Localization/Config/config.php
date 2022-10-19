<?php

$dir_images = 'flags';

return [
    'name' => 'Localization',

    'dir_images' => $dir_images,

    'permissions' => [
        'localization' => [ // this group is required if you want add any module setting, because the permissions are created under this group with the same name (setting)
            'view-languages',
            'create-languages',
            'edit-languages',
            'delete-languages',
            'edit-translations',
        ]
    ],

    /********************************************* Languages *********************************************/
    'languages' => [ // after edit run: `languages:seed` to seed languages in database
        'en' => [
            'name' => 'English',
            // 'dir' => 'ltr', // default ltr
            'is_default' => true // default false
        ],
        // 'ger' => [
        //     'name' => 'German',
        //     // 'dir' => 'ltr', // default ltr
        //     // 'is_default' => false // default false
        // ],
        // 'fr' => [
        //     'name' => 'French',
        //     // 'dir' => 'ltr', // default ltr
        //     // 'is_default' => false // default false
        // ],
        // 'tr' => [
        //     'name' => 'Turkish',
        //     // 'dir' => 'ltr', // default ltr
        //     // 'is_default' => false // default false
        // ],
        // 'pt' => [
        //     'name' => 'Portuguese',
        //     // 'dir' => 'ltr', // default ltr
        //     // 'is_default' => false // default false
        // ],
        'ar' => [
            'name' => 'اللغة العربية',
            'dir' => 'rtl', // default ltr,
            // 'is_default' => false // default false
        ],
        // 'bn' => [
        //     'name' => 'Bengali',
        //     // 'dir' => 'ltr', // default ltr
        //     // 'is_default' => false // default false
        // ],
        // 'ru' => [
        //     'name' => 'Russian',
        //     // 'dir' => 'ltr', // default ltr
        //     // 'is_default' => false // default false
        // ],
        // 'es' => [
        //     'name' => 'Spanish',
        //     // 'dir' => 'ltr', // default ltr
        //     // 'is_default' => false // default false
        // ],
        // 'zh' => [
        //     'name' => 'Chinese',
        //     // 'dir' => 'ltr', // default ltr
        //     // 'is_default' => false // default false
        // ],
    ],
];