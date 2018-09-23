<?php

namespace LaraFilm\Domain\Models\Genre;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\RepositoryInterface;
use LaraFilm\Domain\Models\Genre\Genre;

/**
 * Interface GenreRepositoryInterface
 *
 * @package LaraFilm\Domain\Models\Genre
 */
interface GenreRepositoryInterface extends RepositoryInterface
{
    /**
     * Return all genres.
     *
     * @return array
     */
    public function getAll(): array;

    /**
     * Find the genre.
     *
     * @param Id $id
     *
     * @return \LaraFilm\Domain\Models\Genre\Genre
     */
    public function findById(Id $id): Genre;

    /**
     * Save the genre.
     *
     * @param \LaraFilm\Domain\Models\Genre\Genre $genre
     *
     * @return \LaraFilm\Domain\Models\Genre\Genre
     */
    public function save(Genre $genre): Genre;

    /**
     * Delete the genre.
     *
     * @param \LaraFilm\Domain\Models\Genre\Genre $genre
     *
     * @return bool
     */
    public function delete(Genre $genre): bool;
}
