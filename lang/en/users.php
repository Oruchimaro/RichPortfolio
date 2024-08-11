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
            'avatar' => 'Avatar',
        ],
        'form' => [
            'name' => 'Name',
            'email' => 'Email',
            'email_verified_at' => 'Email Verify Date',
            'password' => 'Password',
            'password_confirm' => 'Password Confirmation',
            'update_password_btn' => 'Update Password',
            'avatar' => 'Avatar',
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
