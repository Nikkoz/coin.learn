<?php

use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Crumbs;

//Dashboard

Breadcrumbs::register('admin.home', static function (Crumbs $crumbs) {
    $crumbs->push(trans('global.title_home'), route('admin.home'));
});

Breadcrumbs::register('admin.coins.index', static function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(trans('coin.title'), route('admin.coins.index'));
});

Breadcrumbs::register('admin.coins.create', static function (Crumbs $crumbs) {
    $crumbs->parent('admin.coins.index');
    $crumbs->push(trans('coin.blade.create.title'), route('admin.coins.create'));
});