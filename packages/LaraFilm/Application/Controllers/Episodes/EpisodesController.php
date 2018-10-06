<?php

namespace LaraFilm\Application\Controllers\Episodes;

use LaraFilm\Application\Controllers\LaraFilmController;
use LaraFilm\Interfaces\Services\EpisodeServiceInterface;

class EpisodesController extends LaraFilmController
{
    private $episodeService;

    public function __construct(EpisodeServiceInterface $episodeService)
    {
        $this->episodeService = $episodeService;
    }

    public function show($id)
    {
        $episodeEntity = $this->episodeService->findById($id);
        $episode = $episodeEntity->toArray();

        return response()->json($episode);
    }
}
