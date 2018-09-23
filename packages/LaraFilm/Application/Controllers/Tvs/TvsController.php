<?php

namespace LaraFilm\Application\Controllers\Tvs;

use LaraFilm\Application\Controllers\LaraFilmController;
use LaraFilm\Interfaces\Services\TvServiceInterface;

class TvsController extends LaraFilmController
{
    private $tvService;

    public function __construct(TvServiceInterface $tvService)
    {
        $this->tvService = $tvService;
    }

    public function index()
    {
        $tvEntities = $this->tvService->getAll();
        $tvs = [];

        foreach ($tvEntities as $tv) {
            $tvs[] = $tv->toArray();
        }

        return response()->json($tvs);
    }
}
