<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class MenuServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(Dispatcher $events): void
    {
        $events->listen(BuildingMenu::class, static function (BuildingMenu $event) {
            /*$event->menu->add('MAIN');
            $event->menu->add([
                'text' => 'Blog',
                'url' => 'admin/blog',
            ]);*/
        });
    }
}
