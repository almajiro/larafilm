<?php

namespace LaraFilm\Domain;

use Illuminate\Support\ServiceProvider;

/*
 * Repositories
 */
use LaraFilm\Infrastructure\Repositories\NetworkRepository;

/*
 * Repository Interfaces
 */
use LaraFilm\Domain\Models\Network\NetworkRepositoryInterface;

/**
 * Class LaraFilmDomainProvider
 *
 * @package LaraFilm\Domain
 */
class LaraFilmDomainProvider extends ServiceProvider
{
    /**
     * Bootstrap LaraFilm domain services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register LaraFilm domain services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            NetworkRepositoryInterface::class,
            NetworkRepository::class
        );
    }
}
