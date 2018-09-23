<?php

namespace LaraFilm\Domain\Models\Tv;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Models\Tv\Tv;
use LaraFilm\Domain\Shared\RepositoryInterface;

/**
 * Interface TvRepositoryInterface
 *
 * @package LaraFilm\Domain\Models\Tv
 */
interface TvRepositoryInterface extends RepositoryInterface
{
    /**
     * Return all tv shows.
     *
     * @return Tv[]
     */
    public function getAll(): array;

    /**
     * Find the tv show.
     *
     * @param Id $id
     *
     * @return \LaraFilm\Domain\Models\Tv\Tv
     */
    public function findById(Id $id): Tv;

    /**
     * Save the tv show.
     *
     * @param \LaraFilm\Domain\Models\Tv\Tv $tv
     *
     * @return \LaraFilm\Domain\Models\Tv\Tv
     */
    public function save(Tv $tv): Tv;

    /**
     * Delete the tv show.
     *
     * @param \LaraFilm\Domain\Models\Tv\Tv $tv
     *
     * @return bool
     */
    public function delete(Tv $tv): bool;
}
