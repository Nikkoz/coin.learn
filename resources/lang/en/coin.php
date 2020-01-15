<?php

return [
    'title'      => 'Coins',
    'list_title' => 'List of coins',
    'title_edit' => 'Coin',
    'type'       => [
        'coin'  => 'Coin',
        'token' => 'Token'
    ],
    'actions'    => [
        'add'    => 'Add coin',
        'update' => 'Update coin',
        'delete' => 'Delete coin',
    ],
    'saved'      => 'Coin saved.',
    'deleted'    => 'Coin deleted.',
    'updated'    => 'Coin ":name" updated.',
    'validation' => [
        'smart_contracts' => 'For a token, you cannot indicate the presence of smart contracts',
    ],
    'blade' => [
        'name'         => 'Name',
        'type'         => 'Type',
        'status'       => 'Status',
        'date_created' => 'Created',
        'date_updated' => 'Updated',
        'create'   => [
            'title' => 'Coin creation',
            'form'  => [
                'code'            => 'Tiker',
                'status'          => 'Status',
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
        'edit'     => [
            'title' => 'Update coin',
        ],
        'save'     => 'Save coin',
        'general'  => [
            'title' => 'General',
            'icon'  => 'Icon',
            'links' => 'Links'
        ],
        'socials'  => [
            'title'       => 'Social links',
            'link'        => 'Link',
            'network'     => 'Network',
            'description' => 'Description',
        ],
        'handbook' => [
            'title' => 'Handbook'
        ]
    ],
    'links' => [
        'title'      => 'Social links',
        'title_one'  => 'Social Link',
        'list_title' => 'Links for coin ":name"',
    ]
];
