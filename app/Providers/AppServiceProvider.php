<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// use App\Repositories\Story\StorieInterface;
// use App\Repositories\Story\StorieRepository;
// use App\Repositories\Cooptation\CooptationInterface;
// use App\Repositories\Cooptation\CooptationRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        require_once app_path() . '/Helpers.php';

        $this->app->bind('App\Repositories\CandidatInterface', 'App\Repositories\CandidatRepository');
        $this->app->bind('App\Repositories\JobInterface', 'App\Repositories\JobRepository');
        $this->app->bind('App\Repositories\AccountInterface', 'App\Repositories\AccountRepository');
        $this->app->bind('App\Repositories\UserInterface', 'App\Repositories\UserRepository');
        $this->app->bind('App\Repositories\StorieInterface', 'App\Repositories\StorieRepository');
        $this->app->bind('App\Repositories\RegionInterface', 'App\Repositories\RegionRepository');
        $this->app->bind('App\Repositories\ResponsibleInterface', 'App\Repositories\ResponsibleRepository');
        $this->app->bind('App\Repositories\LikeInterface', 'App\Repositories\LikeRepository');
        $this->app->bind('App\Repositories\HistoricInterface', 'App\Repositories\HistoricRepository');
        $this->app->bind('App\Repositories\StepInterface', 'App\Repositories\StepRepository');
       
    }

}
