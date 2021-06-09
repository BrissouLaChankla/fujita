<?php

namespace App\Providers;
use View;
use App\Models\Player;

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
        
        View::composer('*', function($view){
            
            View::share('view_name', $view->getName());
        });
    }
    
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share ( 'players', Player::all());
        View::share ('apikey', 'RGAPI-b7144ae0-c814-4cbb-9d6c-d2de11c26f12');
        //
    }
}
