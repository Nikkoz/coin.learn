<?php

namespace App\Providers;

use App\Entities\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{
    private $classes = [
        Post::class,
    ];

    public function boot(): void
    {
        foreach ($this->classes as $class) {
            $this->registerFlusher($class);
        }
    }

    private function registerFlusher(string $class): void
    {
        $flush = static function () use ($class) {
            Post::flushQueryCache([$class]);
        };

        /** @var Model $class */
        $class::created($flush);
        $class::saved($flush);
        $class::updated($flush);
        $class::deleted($flush);
    }
}
