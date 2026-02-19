<?php

namespace App\Providers;

use App\Services\FilePostRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(FilePostRepository::class, function () {
            return new FilePostRepository(config('posts.path', resource_path('posts')));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
