<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'users' => 'c,r,u,d',
            'cities' => 'c,r,u,d',
            'types' => 'c,r,u,d',
            'contents' => 'c,r,u,d',
            'details' => 'c,r,u,d',
        ],
        'admin' => [],
//        'administrator' => [
//            'users' => 'c,r,u,d',
//            'profile' => 'r,u'
//        ],
//        'user' => [
//            'profile' => 'r,u',
//        ],
//        'role_name' => [
//            'module_1_name' => 'c,r,u,d',
//        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
