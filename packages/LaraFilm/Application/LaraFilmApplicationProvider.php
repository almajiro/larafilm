<?php

namespace LaraFilm\Application;

use Illuminate\Support\ServiceProvider;

/*
 * Services
 */
use LaraFilm\Application\Services\NetworkService;


/*
 * Service Interfaces
 */
use LaraFilm\Interfaces\Services\NetworkServiceInterface;

/**
 * Class LaraFilmApplicationProvider
 *
 * @package LaraFilm\Application
 */
class LaraFilmApplicationProvider extends ServiceProvider
{
    /**
     * Bootstrap LaraFilm application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register LaraFilm application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            NetworkServiceInterface::class,
            NetworkService::class
        );
    }
}
