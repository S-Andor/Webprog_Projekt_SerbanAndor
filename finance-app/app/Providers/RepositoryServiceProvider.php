<?php

namespace App\Providers;

use App\Interfaces\ITransactionRepository;
use App\Interfaces\IUsersRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\UsersRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IUsersRepository::class, UsersRepository::class);
        $this->app->bind(ITransactionRepository::class, TransactionRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
