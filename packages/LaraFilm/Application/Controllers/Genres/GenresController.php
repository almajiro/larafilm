<?php

namespace LaraFilm\Application\Controllers\Genres;

use LaraFilm\Application\Controllers\LaraFilmController;
use LaraFilm\Interfaces\Services\GenreServiceInterface;

class GenresController
{
    private $genreService;

    public function __construct(GenreServiceInterface $genreService)
    {
        $this->genreService = $genreService;
    }

    public function index()
    {
        $genreEntities = $this->genreService->getAll();
        $genres = [];

        foreach ($genreEntities as $genre) {
            $genres[] = $genre->toArray();
        }

        return response()->json($genres);
    }
}
