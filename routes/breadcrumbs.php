<?php

use App\Entities\Settings\Consensus;
use App\Entities\Settings\Encryption;
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

// Algorithms

Breadcrumbs::register('admin.settings.algorithms.encryption.index', static function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(trans('settings.blade.algorithms.encryption.list_title'), route('admin.settings.algorithms.encryption.index'));
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