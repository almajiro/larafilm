<?php

namespace LaraFilm\Interfaces\Services;

use LaraFilm\Domain\Models\Season\Season;

/**
 * Interface SeasonServiceInterface
 *
 * @package LaraFilm\Interfaces\Services
 */
interface SeasonServiceInterface
{
    /**
     * Return all seasons.
     *
     * @return \LaraFilm\Domain\Models\Season\Season[]
     */
    public function getAll(): array;

    /**
     * Find the season.
     *
     * @param string $id
     *
     * @return \LaraFilm\Domain\Models\Season\Season
     */
    public function findById(string $id): Season;

    /**
     * Create the season.
     *
     * @param array $data
     *
     * @return \LaraFilm\Domain\Models\Season\Season
     */
    public function create(array $data): Season;

    /**
     * Delete the season.
     *
     * @param Season $season
     *
     * @return \LaraFilm\Domain\Models\Season\Season
     */
    public function delete(Season $season): bool;
}
