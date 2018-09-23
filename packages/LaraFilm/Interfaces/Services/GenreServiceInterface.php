<?php

namespace LaraFilm\Interfaces\Services;

use LaraFilm\Domain\Models\Genre\Genre;

/**
 * Interface GenreServiceInterface
 *
 * @package LaraFilm\Interfaces\Services
 */
interface GenreServiceInterface
{
    /**
     * Return all genres.
     *
     * @return \LaraFilm\Domain\Models\Genre\Genre[]
     */
    public function getAll(): array;

    /**
     * Find the genre.
     *
     * @param string $id
     *
     * @return \LaraFilm\Domain\Models\Genre\Genre
     */
    public function findById(string $id): Genre;

    /**
     * Create the genre.
     *
     * @param string $name
     *
     * @return \LaraFilm\Domain\Models\Genre\Genre
     */
    public function create(string $name): Genre;

    /**
     * Delete the genre.
     *
     * @param Genre $genre
     *
     * @return \LaraFilm\Domain\Models\Genre\Genre
     */
    public function delete(Genre $genre): bool;
}
