<?php

return [
    'blade' => [
        'name'       => 'Name',
        'coin'       => 'Coin',
        'algorithms' => [
            'title'       => 'algorithms',
            'actions'     => [
                'add'    => 'Add algorithm',
                'update' => 'Update algorithm',
                'delete' => 'Delete algorithm'
            ],
            'breadcrumbs' => [
                'update' => 'Algorithm update',
                'create' => 'Algorithm creation'
            ],
            'encryption'  => [
                'title'      => 'Encryption algorithm',
                'list_title' => 'List of encryption algorithms',
            ],
            'consensus'   => [
                'title'      => 'Consensus algorithm',
                'list_title' => 'List of consensus algorithms',
            ],
            'form'        => [
                'name'       => 'Name',
                'btn_save'   => 'Save',
                'btn_update' => 'Update',
            ]
        ],
        'socials'    => [
            'link'     => 'Link',
            'network'  => 'Network',
            'links'    => [

            ],
            'networks' => [
                'title'       => 'Social networks',
                'network'     => 'Social network',
                'name'        => 'Network ":name"',
                'list_title'  => 'List of social networks',
                'breadcrumbs' => [
                    'create' => 'Network creation',
                    'update' => 'Network update'
                ],
                'actions'     => [
                    'add'   => 'Add Network',
                    'saved' => 'Network saved'
                ],
            ],
            'form'     => [
                'btn_save'   => 'Save',
                'btn_update' => 'Update',
            ]
        ]
    ]
];