<?php

namespace Creatify\Authentication\Providers;

use Illuminate\Support\ServiceProvider;
use Creatify\Authentication\Repositories\Interfaces\IUserRepository;
use Creatify\Authentication\Repositories\Repos\UserRepository;
use Creatify\Authentication\Repositories\Interfaces\IPasswordRepository;
use Creatify\Authentication\Repositories\Repos\PasswordRepository;

class AuthenticationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IPasswordRepository::class, PasswordRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->publishes([
            __DIR__.'/../Database/Migrations' => base_path('Creatify/Authentication/database/migrations'),
        ]);
    }
}
