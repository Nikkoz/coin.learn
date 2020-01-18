<?php

return [
    'title'      => 'Coins',
    'list_title' => 'List of coins',
    'title_edit' => 'Coin',
    'type'       => [
        'coin'  => 'Coin',
        'token' => 'Token'
    ],
    'validation' => [
        'smart_contracts' => 'For a token, you cannot indicate the presence of smart contracts',
    ],
    'blade' => [
        'create'   => [
            'form'  => [
                'smart_contracts' => 'The presence of smart contracts',
                'platform'     => 'Platform',
                'date_start'   => 'Launch date',
                'algorithm'    => [
                    'encryption' => 'Encryption algorithm',
                    'consensus'  => 'Consensus algorithm',
                ],
                'mining'       => 'Mining',
                'max_supply'   => 'Total coins',
                'key_features' => 'Key features',
                'use'          => 'Using',
                'icon'         => 'Choose icon ...',
                'site'         => 'Official site',
                'chat'         => 'Chat',
                'link'         => 'Additional links'
            ]
        ],
        'general'  => [
            'title' => 'General',
            'icon'  => 'Icon',
            'links' => 'Links'
        ],
    ]
];
