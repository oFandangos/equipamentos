<?php

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
             'can'  => 'docente'
        ],
        [
            'text' => 'Fila de aprovação',
            'url'  => '/fila',
            'can'  => 'docente'
        ],
    ]
];
