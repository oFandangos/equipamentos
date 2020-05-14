<?php

$workflow_emprestimo =
[
    'type' => 'workflow',
    'metadata' => [
        'title' => 'Workflow Empréstimo',
    ],
    'marking_store' => [
        'type' => 'multiple_state',
        'property' => 'currentPlace', // this is the property on the model
    ],
    'supports' => [\App\Emprestimo::class],
    'initial_places' => 'solicitado', 
    'places' => [
        'solicitado' => [
            'metadata' => [
                'label' => "Equipamento Solicitado",
            ],
        ],
        'deferido' => [
            'metadata' => [
                'label' => "Empréstimo deferido",
            ],
        ],
        'indeferido' => [
            'metadata' => [
                'label' => "Empréstimo Indeferido",
            ],
        ]
    ],
    'transitions' => [
        'analise' => [
            'metadata' => [
                'label' => "Análise",
            ],
            'from' => 'solicitado',
            'to' => ['deferido','indeferido']
        ],
    ],
];

return [
    'workflow_emprestimo' => $workflow_emprestimo
];
