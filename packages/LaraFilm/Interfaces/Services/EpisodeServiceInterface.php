<?php

namespace LaraFilm\Interfaces\Services;

use LaraFilm\Domain\Models\Episode\Episode;
use LaraFilm\Domain\Models\Season\Season;

/**
 * Interface EpisodeServiceInterface
 *
 * @package LaraFilm\Interfaces\Services
 */
interface EpisodeServiceInterface
{
    /**
     * Return all episodes.
     *
     * @return \LaraFilm\Domain\Models\Episode\Episode[]
     */
    public function getAll(): array;

    /**
     * Find the episode.
     *
     * @param string $id
     *
     * @return \LaraFilm\Domain\Models\Episode\Episode
     */
    public function findById(string $id): Episode;

    /**
     * Find the season episodes.
     *
     * @param string $id
     *
     * @return \LaraFilm\Domain\Models\Season\Season[]
     */
    public function findBySeasonId(string $id): array;

    /**
     * Create the episode.
     *
     * @param array $data
     *
     * @return \LaraFilm\Domain\Models\Episode\Episode
     */
    public function create(array $data): Episode;

    /**
     * Delete the episode.
     *
     * @param Episode $episode
     *
     * @return \LaraFilm\Domain\Models\Episode\Episode
     */
    public function delete(Episode $episode): bool;
}
