<?php

return [
    'companyName' => 'Η υπηρεσία μου',
    'adminEmail' => 'admin@example.com',
    'tracking-id' => 'your-tracking-id', // comment this line if no google tracking is used
    'users' => [
        '-1' => [
            'id' => '-1',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
            'role' => 'admin'
        ],
        '1' => [
            'id' => '1',
            'username' => 'data',
            'password' => 'pdekritis',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
            'role' => 'formuser'
        ],
	],
    'forms' => [
        'Any...', 
        'of classname for model handled forms'
    ],
    \app\models\FormDigitalSignature::class => [
        'joint_organisation_type' => 'ΥΠΟΥΡΓΕΙΑ',
        'joint_organisation' => 'ΥΠΟΥΡΓΕΙΟ ΠΑΙΔΕΙΑΣ, ΕΡΕΥΝΑΣ ΚΑΙ ΘΡΗΣΚΕΥΜΑΤΩΝ',
    ]
];
