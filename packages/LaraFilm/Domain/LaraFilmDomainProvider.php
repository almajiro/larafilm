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
use LaraFilm\Infrastructure\Repositories\AssetRepository;
use LaraFilm\Infrastructure\Repositories\AssetImageRepository;
use LaraFilm\Infrastructure\Repositories\AssetVideoRepository;
use LaraFilm\Infrastructure\Repositories\SeasonRepository;
use LaraFilm\Infrastructure\Repositories\EpisodeRepository;

/*
 * Repository Interfaces
 */
use LaraFilm\Domain\Models\Tv\TvRepositoryInterface;
use LaraFilm\Domain\Models\Genre\GenreRepositoryInterface;
use LaraFilm\Domain\Models\Actor\ActorRepositoryInterface;
use LaraFilm\Domain\Models\Person\PersonRepositoryInterface;
use LaraFilm\Domain\Models\Company\CompanyRepositoryInterface;
use LaraFilm\Domain\Models\Asset\AssetRepositoryInterface;
use LaraFilm\Domain\Models\Asset\AssetImageRepositoryInterface;
use LaraFilm\Domain\Models\Asset\AssetVideoRepositoryInterface;
use LaraFilm\Domain\Models\Season\SeasonRepositoryInterface;
use LaraFilm\Domain\Models\Episode\EpisodeRepositoryInterface;

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

        $this->app->bind(
            AssetRepositoryInterface::class,
            AssetRepository::class
        );

        $this->app->bind(
            AssetImageRepositoryInterface::class,
            AssetImageRepository::class
        );

        $this->app->bind(
            SeasonRepositoryInterface::class,
            SeasonRepository::class
        );

        $this->app->bind(
            EpisodeRepositoryInterface::class,
            EpisodeRepository::class
        );

        $this->app->bind(
            AssetVideoRepositoryInterface::class,
            AssetVideoRepository::class
        );
    }
}
