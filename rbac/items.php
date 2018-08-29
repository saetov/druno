<?php
return [
    'dashboard' => [
        'type' => 2,
        'description' => 'Админ панель',
    ],
    'worker' => [
        'type' => 1,
        'description' => 'Пользователь',
        'ruleName' => 'userRole',
    ],
    'manager' => [
        'type' => 1,
        'description' => 'Менеджер',
        'ruleName' => 'userRole',
        'children' => [
            'worker',
            'dashboard',
        ],
    ],
    'admin' => [
        'type' => 1,
        'description' => 'Администратор',
        'ruleName' => 'userRole',
        'children' => [
            'manager',
        ],
    ],
];
