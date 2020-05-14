<?php

return [
    'title'=> 'USPdev',
    'dashboard_url' => '/',
    'logout_method' => 'GET',
    'logout_url' => '/logout',
    'login_url' => '/login',
    'menu' => [
        [
            'text' => 'Solicitar Empréstimo de Equipamento',
            'url'  => '/item1'
        ],
        [
            'text' => 'Equipamentos Emprestados',
            'url'  => '/item2',
        ],
    ]
];
