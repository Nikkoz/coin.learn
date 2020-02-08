<?php

return [
    'menu' => [
        [
            'text'   => 'search',
            'search' => true,
            'topnav' => true,
        ],
        ['header' => 'account_settings'],
        [
            'text' => 'Users',
        ],
        ['header' => 'main_menu'],
        [
            'text'   => 'coins',
            'key'    => 'coins',
            'icon'   => 'nav-icon fa-fw fab fa-bitcoin',
            'route'  => 'admin.coins.index',
            'active' => ['coins', 'coins/*'],
        ], [
            'text'    => 'resources',
            'key'     => 'resources',
            'icon'    => 'nav-icon fa-fw fa fa-rss-square',
            'submenu' => [
                [
                    'text'   => 'news',
                    'key'    => 'news',
                    'icon'   => 'fa-fw fa fa-newspaper ml-3',
                    'route'  => 'admin.news.index',
                    'active' => ['news', 'news/*'],
                ], [
                    'text'   => 'twitter',
                    'key'    => 'twitter',
                    'icon'   => 'fa-fw fab fa-twitter ml-3',
                    'route'  => 'admin.twitter.index',
                    'active' => ['twitter', 'twitter/*'],
                ], [
                    'text'   => 'facebook',
                    'key'    => 'facebook',
                    'icon'   => 'fa-fw fab fa-facebook ml-3',
                    'route'  => 'admin.facebook.index',
                    'active' => ['facebook', 'facebook/*'],
                ], [
                    'text'   => 'reddit',
                    'key'    => 'reddit',
                    'icon'   => 'fa-fw fab fa-reddit ml-3',
                    'route'  => 'admin.reddit.index',
                    'active' => ['reddit', 'reddit/*'],
                ],
            ],
        ],
        ['header' => 'settings'],
        [
            'text'   => 'handbooks',
            'icon'   => 'fa-fw fa fa-book',
            'route'  => 'admin.settings.handbooks.index',
            'active' => ['settings/handbooks', 'settings/handbooks/*'],
        ], [
            'text'   => 'social_networks',
            'icon'   => 'fa-fw fab fa-vk',
            'route'  => 'admin.settings.social.networks.index',
            'active' => ['settings/social/networks', 'settings/social/networks/*'],
        ], [
            'text'   => 'sites',
            'key'    => 'sites',
            'icon'   => 'fa-fw fab fa-internet-explorer',
            'route'  => 'admin.settings.sites.index',
            'active' => ['settings/sites', 'settings/sites/*'],
        ], [
            'text'   => 'exchanges',
            'icon'   => 'fa-fw fa fa-exchange-alt',
            'route'  => 'admin.settings.exchanges.index',
            'active' => ['settings/exchanges', 'settings/exchanges/*'],
        ], [
            'text'    => 'algorithms',
            'icon'    => 'fa-fw fab fa-gg',
            'submenu' => [
                [
                    'text'   => 'encryption',
                    'icon'   => 'far fa-fw fa-circle ml-3',
                    'route'  => 'admin.settings.algorithms.encryption.index',
                    'active' => ['settings/algorithms/encryption', 'settings/algorithms/encryption/*'],
                ], [
                    'text'   => 'consensus',
                    'icon'   => 'far fa-fw fa-circle ml-3',
                    'route'  => 'admin.settings.algorithms.consensus.index',
                    'active' => ['settings/algorithms/consensus', 'settings/algorithms/consensus/*'],
                ],
            ],
        ], [
            'text'   => 'formula',
            'icon'   => 'fa-fw fa fa-chart-area',
            'route'  => 'admin.settings.formula.index',
            'active' => ['settings/formula'],
        ],
    ],
];