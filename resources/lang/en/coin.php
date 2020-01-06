<?php

return [
    'title' => 'Coins',
    'list_title' => 'List of coins',
    'title_edit' => 'Coin',
    'type' => [
        'coin' => 'Coin',
        'token' => 'Token'
    ],
    'actions' => [
        'add' => 'Add coin',
        'update' => 'Update coin',
        'delete' => 'Delete coin'
    ],
    'blade' => [
        'image_title' => 'Icon',
        'links_title' => 'Links',
        'name' => 'Name',
        'type' => 'Type',
        'status' => 'Status',
        'date_created' => 'Created',
        'date_updated' => 'Updated',
        'create' => [
            'title' => 'Coin creation',
            'form' => [
                'name' => 'Name',
                'code' => 'Tiker',
                'type' => 'Type',
                'status' => 'Status',
                'smart_contracts' => 'The presence of smart contracts',
                'platform' => 'Platform',
                'date_start' => 'Launch date',
                'algorithm' => [
                    'encryption' => 'Encryption algorithm',
                    'consensus' => 'Consensus algorithm',
                ],
                'mining' => 'Mining',
                'max_supply' => 'Total coins',
                'key_features' => 'Key features',
                'use' => 'Using',
                'icon' => 'Choose icon',
            ]
        ],

    ]
];