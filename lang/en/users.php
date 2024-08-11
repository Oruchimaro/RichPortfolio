<?php

return [
    'index' => [
        'table' => [
            'id' => 'Id',
            'name' => 'Name',
            'email' => 'Email',
            'email_verified_at' => 'Joined At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ],
        'form' => [
            'name' => 'Name',
            'email' => 'Email',
            'email_verified_at' => 'Email Verify Date',
            'password' => 'Password',
            'password_confirm' => 'Password Confirmation',
            'update_password_btn' => 'Update Password',
        ],
    ],

    'navigation' => [
        'group' => 'User Management',
        'models' => [
            'users' => 'Users',
            'user' => 'User',
        ],
    ],
];
