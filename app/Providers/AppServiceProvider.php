<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind( \App\Contracts\Repositories\Blog::class, \App\Repositories\Eloquent\Blog::class );
        $this->app->bind( \App\Contracts\Repositories\BlogComments::class, \App\Repositories\Eloquent\BlogComments::class );

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
