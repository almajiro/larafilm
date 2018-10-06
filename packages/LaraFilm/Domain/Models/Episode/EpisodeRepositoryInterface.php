<?php

namespace LaraFilm\Domain\Models\Episode;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\RepositoryInterface;
use LaraFilm\Domain\Models\Episode\Episode;
use LaraFilm\Domain\Models\Season\Season;

/**
 * Interface EpisodeRepositoryInterface
 *
 * @package LaraFilm\Domain\Models\Episode
 */
interface EpisodeRepositoryInterface extends RepositoryInterface
{
    /**
     * Return all episodes.
     *
     * @return array
     */
    public function getAll(): array;

    /**
     * Find the episode.
     *
     * @param Id $id
     *
     * @return \LaraFilm\Domain\Models\Episode\Episode
     */
    public function findById(Id $id): Episode;

    /**
     * Find by season.
     *
     * @param Season $season
     *
     * @return Season[]
     */
    public function findBySeason(Season $season): array;

    /**
     * Save the episode.
     *
     * @param \LaraFilm\Domain\Models\Episode\Episode $episode
     *
     * @return \LaraFilm\Domain\Models\Episode\Episode
     */
    public function save(Episode $episode): Episode;

    /**
     * Delete the episode.
     *
     * @param \LaraFilm\Domain\Models\Episode\Episode $episode
     *
     * @return bool
     */
    public function delete(Episode $episode): bool;
}
