<?php

namespace App\Providers;

use App\Repositories\BasicRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\FilterGroupRepository;
use App\Repositories\Interfaces\BasicRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\FilterGroupRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(BasicRepositoryInterface::class, BasicRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(FilterGroupRepositoryInterface::class, FilterGroupRepository::class);
    }
}
