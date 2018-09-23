<?php

namespace LaraFilm\Application\Controllers\Actors;

use LaraFilm\Application\Controllers\LaraFilmController;
use LaraFilm\Interfaces\Services\ActorServiceInterface;

class ActorsController
{
    private $actorService;

    public function __construct(ActorServiceInterface $actorService)
    {
        $this->actorService = $actorService;
    }

    public function index()
    {
        $actorEntities = $this->actorService->getAll();
        $actors = [];

        foreach ($actorEntities as $actor) {
            $actors[] = $actor->toArray();
        }

        return response()->json($actors);
    }
}
