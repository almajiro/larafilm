<?php

namespace LaraFilm\Domain\Models\Season;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\RepositoryInterface;
use LaraFilm\Domain\Models\Season\Season;

/**
 * Interface SeasonRepositoryInterface
 *
 * @package LaraFilm\Domain\Models\Season
 */
interface SeasonRepositoryInterface extends RepositoryInterface
{
    /**
     * Return all seasons.
     *
     * @return array
     */
    public function getAll(): array;

    /**
     * Find the season.
     *
     * @param Id $id
     *
     * @return \LaraFilm\Domain\Models\Season\Season
     */
    public function findById(Id $id): Season;

    /**
     * Save the season.
     *
     * @param \LaraFilm\Domain\Models\Season\Season $season
     *
     * @return \LaraFilm\Domain\Models\Season\Season
     */
    public function save(Season $season): Season;

    /**
     * Delete the season.
     *
     * @param \LaraFilm\Domain\Models\Season\Season $season
     *
     * @return bool
     */
    public function delete(Season $season): bool;
}
