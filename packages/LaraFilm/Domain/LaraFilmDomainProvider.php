<?php

namespace LaraFilm\Domain;

use Illuminate\Support\ServiceProvider;

/*
 * Repositories
 */
use LaraFilm\Infrastructure\Repositories\TvRepository;
use LaraFilm\Infrastructure\Repositories\GenreRepository;
use LaraFilm\Infrastructure\Repositories\ActorRepository;
use LaraFilm\Infrastructure\Repositories\PersonRepository;
use LaraFilm\Infrastructure\Repositories\CompanyRepository;

/*
 * Repository Interfaces
 */
use LaraFilm\Domain\Models\Tv\TvRepositoryInterface;
use LaraFilm\Domain\Models\Genre\GenreRepositoryInterface;
use LaraFilm\Domain\Models\Actor\ActorRepositoryInterface;
use LaraFilm\Domain\Models\Person\PersonRepositoryInterface;
use LaraFilm\Domain\Models\Company\CompanyRepositoryInterface;

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
            TvRepositoryInterface::class,
            TvRepository::class
        );

        $this->app->bind(
            CompanyRepositoryInterface::class,
            CompanyRepository::class
        );

        $this->app->bind(
            GenreRepositoryInterface::class,
            GenreRepository::class
        );

        $this->app->bind(
            PersonRepositoryInterface::class,
            PersonRepository::class
        );

        $this->app->bind(
            ActorRepositoryInterface::class,
            ActorRepository::class
        );
    }
}
