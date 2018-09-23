<?php

namespace LaraFilm\Interfaces\Services;

use LaraFilm\Domain\Models\Tv\Tv;

/**
 * Interface TvServiceInterface
 *
 * @package LaraFilm\Interfaces\Services
 */
interface TvServiceInterface
{
    /**
     * Return all tv shows..
     *
     * @return \LaraFilm\Domain\Models\Tv\Tv[]
     */
    public function getAll(): array;

    /**
     * Find the tv show.
     *
     * @param string $id
     *
     * @return Tv
     */
    public function findById(string $id): Tv;

    /**
     * Create the tv show,
     *
     * @param array $data
     *
     * @return Tv
     */
    public function create(array $data): Tv;

    /**
     * Delete the tv show.
     *
     * @param Tv $tv
     *
     * @return bool
     */
    public function delete(Tv $tv): bool;
}
