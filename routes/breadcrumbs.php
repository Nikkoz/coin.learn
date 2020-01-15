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
    $crumbs->push(trans('coin.blade.create.title'), route('admin.coins.create'));
});

Breadcrumbs::register(
    'admin.coins.edit', static function (Crumbs $crumbs, int $id) {
    $crumbs->parent('admin.coins.index');
    $crumbs->push(trans('coin.blade.edit.title'), route('admin.coins.edit', $id));
});


// Links

Breadcrumbs::register(
    'admin.links.index', static function (Crumbs $crumbs, int $coinId) {
    $crumbs->parent('admin.coins.edit', $coinId);
    $crumbs->push(trans('coin.links.title'), route('admin.links.index', $coinId));
});

Breadcrumbs::register(
    'admin.links.create', static function (Crumbs $crumbs, int $coinId) {
    $crumbs->parent('admin.links.index', $coinId);
    $crumbs->push(trans('global.actions.objects.creation', ['object' => 'Link']), route('admin.links.create', $coinId));
});

Breadcrumbs::register(
    'admin.links.edit', static function (Crumbs $crumbs, int $coinId, int $id) {
    $crumbs->parent('admin.links.index', $coinId);
    $crumbs->push(
        trans('global.actions.objects.update', ['object' => 'Link']),
        route('admin.links.update', ['coinId' => $coinId, 'id' => $id]));
});


// Algorithms

Breadcrumbs::register(
    'admin.settings.algorithms.encryption.index', static function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(
        trans('settings.blade.algorithms.encryption.list_title'), route('admin.settings.algorithms.encryption.index'));
});

Breadcrumbs::register(
    'admin.settings.algorithms.encryption.create', static function (Crumbs $crumbs) {
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
    $crumbs->push(trans('settings.blade.socials.networks.breadcrumbs.create'), route('admin.settings.social.networks.create'));
});

Breadcrumbs::register('admin.settings.social.networks.edit', static function (Crumbs $crumbs, int $id) {
    $crumbs->parent('admin.settings.social.networks.index');
    $crumbs->push(trans('settings.blade.socials.networks.breadcrumbs.update'), route('admin.settings.social.networks.edit', $id));
});