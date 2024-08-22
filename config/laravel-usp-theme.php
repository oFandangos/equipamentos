<?php

$right_menu = [
    [
        'text' => '<i class="fas fa-hard-hat"></i>',
        'title' => 'Logs',
        'target' => '_blank',
        'url' => config('app.url') . '/logs',
        'align' => 'right',
        'can' => 'admin',
    ],
];

return [
    'title'=> 'FFLCH',
    'skin' => env('USP_THEME_SKIN', 'uspdev'),
    'app_url' => config('app.url'),
    'logout_method' => 'POST',
    'logout_url' => config('app.url') . '/logout',
    'login_url' => config('app.url') . '/login',
    'menu' => [
        [
            'text' => 'Solicitar Empréstimo de Equipamento',
            'url'  => '/emprestimo/create',
        ],
        [
            'text' => 'Equipamentos Emprestados',
            'url'  => '/emprestimo',
             'can'  => 'admin'
        ],
        [
            'text' => 'Fila de aprovação',
            'url'  => '/fila',
            'can'  => 'admin'
        ],
    ],
    'right_menu' => $right_menu,
];
