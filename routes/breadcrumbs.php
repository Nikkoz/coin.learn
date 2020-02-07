<?php

use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Crumbs;

//// Dashboard

Breadcrumbs::register('admin.home', static function (Crumbs $crumbs) {
    $crumbs->push(trans('global.title_home'), route('admin.home'));
});


// Coins

Breadcrumbs::register('admin.coins.index', static function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(trans('coin.title'), route('admin.coins.index'));
});

Breadcrumbs::register('admin.coins.create', static function (Crumbs $crumbs) {
    $crumbs->parent('admin.coins.index');
    $crumbs->push(trans('global.actions.objects.creation', ['object' => 'Coin']), route('admin.coins.create'));
});

Breadcrumbs::register('admin.coins.edit', static function (Crumbs $crumbs, int $id) {
    $crumbs->parent('admin.coins.index');
    $crumbs->push(trans('global.actions.objects.update', ['object' => 'Coin']), route('admin.coins.edit', $id));
});


// Links

Breadcrumbs::register('admin.links.index', static function (Crumbs $crumbs, int $coinId) {
    $crumbs->parent('admin.coins.edit', $coinId);
    $crumbs->push(trans('links.title'), route('admin.links.index', $coinId));
});

Breadcrumbs::register('admin.links.create', static function (Crumbs $crumbs, int $coinId) {
    $crumbs->parent('admin.links.index', $coinId);
    $crumbs->push(trans('global.actions.objects.creation', ['object' => 'Link']), route('admin.links.create', $coinId));
});

Breadcrumbs::register('admin.links.edit', static function (Crumbs $crumbs, int $coinId, int $id) {
    $crumbs->parent('admin.links.index', $coinId);
    $crumbs->push(
        trans('global.actions.objects.update', ['object' => 'Link']),
        route('admin.links.update', ['coinId' => $coinId, 'id' => $id])
    );
});

// Handbooks in Coin

Breadcrumbs::register('admin.coins.handbooks.index', static function (Crumbs $crumbs, int $coinId) {
    $crumbs->parent('admin.coins.edit', $coinId);
    $crumbs->push(trans('handbooks.title'), route('admin.coins.handbooks.index', $coinId));
});

Breadcrumbs::register('admin.coins.handbooks.create', static function (Crumbs $crumbs, int $coinId) {
    $crumbs->parent('admin.coins.handbooks.index', $coinId);
    $crumbs->push(
        trans('global.actions.objects.creation', ['object' => 'Handbook']),
        route('admin.coins.handbooks.create', $coinId)
    );
});

Breadcrumbs::register('admin.coins.handbooks.edit', static function (Crumbs $crumbs, int $coinId, int $id) {
    $crumbs->parent('admin.coins.handbooks.index', $coinId);
    $crumbs->push(
        trans('global.actions.objects.update', ['object' => 'Handbook']),
        route('admin.coins.handbooks.update', ['coinId' => $coinId, 'id' => $id])
    );
});

// Posts

Breadcrumbs::register('admin.news.index', static function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(trans('global.blade.title.news'), route('admin.news.index'));
});

Breadcrumbs::register('admin.news.create', static function (Crumbs $crumbs) {
    $crumbs->parent('admin.news.index');
    $crumbs->push(trans('global.actions.objects.add', ['object' => 'post']), route('admin.news.create'));
});

Breadcrumbs::register('admin.news.edit', static function (Crumbs $crumbs, int $id) {
    $crumbs->parent('admin.news.index');
    $crumbs->push(trans('global.actions.objects.update', ['object' => 'News']), route('admin.news.edit', $id));
});

// Posts

Breadcrumbs::register('admin.twitter.index', static function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(trans('global.blade.title.twitter'), route('admin.twitter.index'));
});

Breadcrumbs::register('admin.twitter.create', static function (Crumbs $crumbs) {
    $crumbs->parent('admin.twitter.index');
    $crumbs->push(trans('global.actions.objects.add', ['object' => 'post']), route('admin.twitter.create'));
});

Breadcrumbs::register('admin.twitter.edit', static function (Crumbs $crumbs, int $id) {
    $crumbs->parent('admin.twitter.index');
    $crumbs->push(trans('global.actions.objects.update', ['object' => 'Twitter']), route('admin.twitter.edit', $id));
});

// Algorithms

Breadcrumbs::register('admin.settings.algorithms.encryption.index', static function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(
        trans('settings.blade.algorithms.encryption.list_title'), route('admin.settings.algorithms.encryption.index'));
});

Breadcrumbs::register('admin.settings.algorithms.encryption.create', static function (Crumbs $crumbs) {
    $crumbs->parent('admin.settings.algorithms.encryption.index');
    $crumbs->push(trans('settings.blade.algorithms.create'), route('admin.settings.algorithms.encryption.create'));
});

Breadcrumbs::register('admin.settings.algorithms.encryption.edit', static function (Crumbs $crumbs, int $id) {
    $crumbs->parent('admin.settings.algorithms.encryption.index');
    $crumbs->push(trans('settings.blade.algorithms.breadcrumbs.update'), route('admin.settings.algorithms.encryption.edit', $id));
});

Breadcrumbs::register('admin.settings.algorithms.consensus.index', static function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(trans('settings.blade.algorithms.consensus.list_title'), route('admin.settings.algorithms.consensus.index'));
});

Breadcrumbs::register('admin.settings.algorithms.consensus.create', static function (Crumbs $crumbs) {
    $crumbs->parent('admin.settings.algorithms.consensus.index');
    $crumbs->push(trans('settings.blade.consensus.create'), route('admin.settings.algorithms.consensus.create'));
});

Breadcrumbs::register('admin.settings.algorithms.consensus.edit', static function (Crumbs $crumbs, int $id) {
    $crumbs->parent('admin.settings.algorithms.consensus.index');
    $crumbs->push(trans('settings.blade.algorithms.breadcrumbs.update'), route('admin.settings.algorithms.consensus.edit', $id));
});


// Social networks

Breadcrumbs::register('admin.settings.social.networks.index', static function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(trans('settings.blade.socials.networks.title'), route('admin.settings.social.networks.index'));
});

Breadcrumbs::register('admin.settings.social.networks.create', static function (Crumbs $crumbs) {
    $crumbs->parent('admin.settings.social.networks.index');
    $crumbs->push(trans('global.actions.objects.add', ['object' => 'Network']), route('admin.settings.social.networks.create'));
});

Breadcrumbs::register('admin.settings.social.networks.edit', static function (Crumbs $crumbs, int $id) {
    $crumbs->parent('admin.settings.social.networks.index');
    $crumbs->push(
        trans('global.actions.objects.update', ['object' => 'Network']),
        route('admin.settings.social.networks.edit', $id)
    );
});


// Handbooks

Breadcrumbs::register('admin.settings.handbooks.index', static function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(trans('handbooks.title'), route('admin.settings.handbooks.index'));
});

Breadcrumbs::register('admin.settings.handbooks.create', static function (Crumbs $crumbs) {
    $crumbs->parent('admin.settings.handbooks.index');
    $crumbs->push(trans('global.actions.objects.add', ['object' => 'Handbook']), route('admin.settings.handbooks.create'));
});

Breadcrumbs::register('admin.settings.handbooks.edit', static function (Crumbs $crumbs, int $id) {
    $crumbs->parent('admin.settings.handbooks.index');
    $crumbs->push(trans('global.actions.objects.update', ['object' => 'Handbook']), route('admin.settings.handbooks.edit', $id));
});


// Sites

Breadcrumbs::register('admin.settings.sites.index', static function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(trans('sites.title'), route('admin.settings.sites.index'));
});

Breadcrumbs::register('admin.settings.sites.create', static function (Crumbs $crumbs) {
    $crumbs->parent('admin.settings.sites.index');
    $crumbs->push(trans('global.actions.objects.add', ['object' => 'Site']), route('admin.settings.sites.create'));
});

Breadcrumbs::register('admin.settings.sites.edit', static function (Crumbs $crumbs, int $id) {
    $crumbs->parent('admin.settings.sites.index');
    $crumbs->push(trans('global.actions.objects.update', ['object' => 'Site']), route('admin.settings.sites.edit', $id));
});

// Exchanges

Breadcrumbs::register('admin.settings.exchanges.index', static function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(trans('global.blade.title.exchanges'), route('admin.settings.exchanges.index'));
});

Breadcrumbs::register('admin.settings.exchanges.create', static function (Crumbs $crumbs) {
    $crumbs->parent('admin.settings.exchanges.index');
    $crumbs->push(trans('global.actions.objects.add', ['object' => 'Exchange']), route('admin.settings.exchanges.create'));
});

Breadcrumbs::register('admin.settings.exchanges.edit', static function (Crumbs $crumbs, int $id) {
    $crumbs->parent('admin.settings.exchanges.index');
    $crumbs->push(trans('global.actions.objects.update', ['object' => 'Exchange']), route('admin.settings.exchanges.edit', $id));
});