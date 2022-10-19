<?php

return [
    'name' => 'Main',

    'permissions' => [
        'setting' => [ // this group is required if you want add any module setting, because the permissions are created under this group with the same name (setting)
            'manage-setting',
            'manage-theme-setting',
            'manage-theme',
            'manage-notifications-setting',
            'manage-google-setting',
        ],
    ],
];
