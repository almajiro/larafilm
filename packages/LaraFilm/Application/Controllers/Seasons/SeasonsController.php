<?php

namespace LaraFilm\Application\Controllers\Seasons;

use LaraFilm\Application\Controllers\LaraFilmController;
use LaraFilm\Interfaces\Services\SeasonServiceInterface;
use LaraFilm\Interfaces\Services\EpisodeServiceInterface;

class SeasonsController extends LaraFilmController
{
    private $episodeService;

    private $seasonService;

    public function __construct(
        EpisodeServiceInterface $episodeService,
        SeasonServiceInterface $seasonService
    ) {
        $this->episodeService = $episodeService;
        $this->seasonService = $seasonService;
    }

    public function episodes($seasonId)
    {
        $episodeEntities = $this->episodeService->findBySeasonId($seasonId);
        $episodes = [];

        foreach ($episodeEntities as $episode) {
            $episodes[] = $episode->toArray();
        }

        return response()->json($episodes);
    }

    public function show($seasionId)
    {
        $seasonEntity = $this->seasonService->findById($seasionId);
        $season = $seasonEntity->toArray();

        return response()->json($season);
    }
}
