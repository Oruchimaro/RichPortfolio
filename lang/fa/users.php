<?php

return [
    'index' => [
        'table' => [
            'id' => 'شناسه',
            'name' => 'نام',
            'email' => 'ایمیل',
            'email_verified_at' => 'تاریخ عضپویت',
            'created_at' => 'تاریخ ایجاد',
            'updated_at' => 'تاریخ بخ‌روز‌رسانی',
        ],
        'form' => [
            'name' => 'نام',
            'email' => 'ایمیل',
            'email_verified_at' => 'تاریخ عضپویت',
            'password' => 'رمز‌عبور',
            'password_confirm' => 'تکرار رمز‌عبور',
            'update_password_btn' => 'به‌روزرسانی رمزعبور',
        ],
    ],
    'navigation' => [
        'group' => 'بخش کاربران',
        'models' => [
            'users' => 'کاربران',
            'user' => 'کاربر',
        ],
    ],
];
