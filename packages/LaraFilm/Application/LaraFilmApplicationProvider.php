<?php

namespace LaraFilm\Application;

use Illuminate\Support\ServiceProvider;

/*
 * Services
 */
use LaraFilm\Application\Services\TvService;
use LaraFilm\Application\Services\GenreService;
use LaraFilm\Application\Services\ActorService;
use LaraFilm\Application\Services\PersonService;
use LaraFilm\Application\Services\CompanyService;
use LaraFilm\Application\Services\AssetService;
use LaraFilm\Application\Services\AssetImageService;
use LaraFilm\Application\Services\AssetVideoService;
use LaraFilm\Application\Services\SeasonService;
use LaraFilm\Application\Services\EpisodeService;
/*
 * Service Interfaces
 */

use LaraFilm\Interfaces\Services\TvServiceInterface;
use LaraFilm\Interfaces\Services\GenreServiceInterface;
use LaraFilm\Interfaces\Services\ActorServiceInterface;
use LaraFilm\Interfaces\Services\PersonServiceInterface;
use LaraFilm\Interfaces\Services\CompanyServiceInterface;
use LaraFilm\Interfaces\Services\AssetServiceInterface;
use LaraFilm\Interfaces\Services\AssetImageServiceInterface;
use LaraFilm\Interfaces\Services\AssetVideoServiceInterface;
use LaraFilm\Interfaces\Services\SeasonServiceInterface;
use LaraFilm\Interfaces\Services\EpisodeServiceInterface;

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
            TvServiceInterface::class,
            TvService::class
        );

        $this->app->bind(
            CompanyServiceInterface::class,
            CompanyService::class
        );

        $this->app->bind(
            GenreServiceInterface::class,
            GenreService::class
        );

        $this->app->bind(
            PersonServiceInterface::class,
            PersonService::class
        );

        $this->app->bind(
            ActorServiceInterface::class,
            ActorService::class
        );

        $this->app->bind(
            AssetServiceInterface::class,
            AssetService::class
        );

        $this->app->bind(
            AssetImageServiceInterface::class,
            AssetImageService::class
        );

        $this->app->bind(
            SeasonServiceInterface::class,
            SeasonService::class
        );

        $this->app->bind(
            EpisodeServiceInterface::class,
            EpisodeService::class
        );

        $this->app->bind(
            AssetVideoServiceInterface::class,
            AssetVideoService::class
        );
    }
}
