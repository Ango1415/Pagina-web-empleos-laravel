<?php

namespace App\Providers;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Model::unguard()  //Esto es para que no pida el fillable en el formulario de crear jobs, pero no me gustó esta forma
        //Paginator::useBoostrapFive(); él dió este ejemplo como posible forma de aplicar boostrap en lugar de tailwind, pero no sé si sea posible.
        
    }
}
