<?php

return [
    'name' => 'Currency',

    'permissions' => [
        'currencies' => [ // this group is required if you want add any module setting, because the permissions are created under this group with the same name (setting)
            'manage-currencies',
            'view-currencies',
            'create-currencies',
            'edit-currencies',
            'delete-currencies',
            'export-table-currencies',
            'set-default-currency',
        ],
    ]
];
