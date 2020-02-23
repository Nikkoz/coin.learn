<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use App\Dictionaries\PostTypeDictionary;
use Illuminate\Contracts\Events\Dispatcher;
use App\Repositories\Dashboard\PostRepository;
use App\Repositories\Dashboard\SiteRepository;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class MenuServiceProvider extends ServiceProvider
{
    public function boot(Dispatcher $events): void
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $config = app()->make('config')->get('dashboard');
            $menu = collect($config['menu']);

            $menu->each(function (array $item) use ($event) {
                if (isset($item['key']) && $item['key'] === 'resources') {
                    $item['submenu'] = $this->prepareResourcePoint(collect($item['submenu']));
                }

                if (isset($item['key']) && $item['key'] === 'sites') {
                    $item = Arr::collapse([$item, $this->prepareSitesPoint()]);
                }

                $event->menu->add($item);
            });
        });
    }

    protected function prepareResourcePoint(Collection $menu): array
    {
        return $menu->map(function (array $item) {
            return $this->setLabel($item);
        })->all();
    }

    protected function setLabel(array $item): array
    {
        $repository = app(PostRepository::class);

        $date = Carbon::now()->subDay()->format('Y-m-d H:i:s');
        $posts = $repository->countInTypes([
            'created_at' => [
                'operator' => '>=',
                'value'    => $date,
            ],
        ], true);

        switch ($item['key']) {
            case 'news':
                $label = $posts ? $posts[PostTypeDictionary::TYPE_POST] : 0;
                break;
            case 'twitter':
                $label = $posts ? $posts[PostTypeDictionary::TYPE_TWITTER] : 0;
                break;
            case 'facebook':
                $label = $posts ? $posts[PostTypeDictionary::TYPE_FACEBOOK] : 0;
                break;
            case 'reddit':
                $label = $posts ? $posts[PostTypeDictionary::TYPE_REDDIT] : 0;
                break;
        }

        return array_merge($item, [
            'label'       => $label ?? 0,
            'label_color' => $this->labelColor(),
        ]);
    }

    protected function prepareSitesPoint(): array
    {
        $repository = app(SiteRepository::class);

        return [
            'label'       => $repository->count(),
            'label_color' => $this->labelColor(),
        ];
    }

    protected function labelColor(): string
    {
        return Arr::random(['success', 'info', 'primary', 'warning', 'danger']);
    }
}
