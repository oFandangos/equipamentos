<?php

$workflow_emprestimo =
[
    'type' => 'workflow',
    'metadata' => [
        'title' => 'Workflow Empréstimo',
    ],
    'marking_store' => [
        'type' => 'single_state',
        'property' => 'status', // this is the property on the model
    ],
    'supports' => [\App\Emprestimo::class],
    'initial_places' => 'solicitado',
    'places' => [
        'solicitado' => [
            'metadata' => [
                'label' => "Solicitado",
            ],
        ],
        'deferido' => [
            'metadata' => [
                'label' => "Deferido",
            ],
        ],
        'indeferido' => [
            'metadata' => [
                'label' => "Indeferido",
            ],
        ]
    ],
    'transitions' => [
        'deferir' => [
            'from' => ['solicitado','indeferido','deferido'],
            'to' => 'deferido',
        ],
        'indeferir' => [
            'from' => ['solicitado','deferido','indeferido'],
            'to' => 'indeferido',
        ],
    ],
];

return [
    'workflow_emprestimo' => $workflow_emprestimo
];
