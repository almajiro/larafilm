<?php

namespace LaraFilm\Application\Services;

use Carbon\Carbon;
use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Models\Episode\Episode;
use LaraFilm\Domain\Models\Season\SeasonRepositoryInterface;
use LaraFilm\Domain\Models\Episode\EpisodeRepositoryInterface;
use LaraFilm\Interfaces\Services\EpisodeServiceInterface;

/**
 * Class EpisodeService
 *
 * @package LaraFilm\Application\Services
 */
class EpisodeService implements EpisodeServiceInterface
{
    /**
     * @var EpisodeRepositoryInterface
     */
    private $episodeRepository;

    private $seasonRepository;

    /**
     * EpisodeService constructor.
     *
     * @param EpisodeRepositoryInterface $episodeRepository
     */
    public function __construct(
        SeasonRepositoryInterface $seasonRepository,
        EpisodeRepositoryInterface $episodeRepository
    ) {
        $this->seasonRepository = $seasonRepository;
        $this->episodeRepository = $episodeRepository;
    }

    /**
     * Get all episodes.
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->episodeRepository->getAll();
    }

    /**
     * Find the episode.
     *
     * @param string $id
     *
     * @return Episode
     */
    public function findById(string $id): Episode
    {
        return $this->episodeRepository->findById(new Id($id));
    }

    public function findBySeasonId(string $id): array
    {
        $season = $this->seasonRepository->findById(new Id($id));
        $episodes = $this->episodeRepository->findBySeason($season);

        return $episodes;
    }

    /**
     * Create the episode.
     *
     * @param array $data
     *
     * @return Episode
     */
    public function create(array $data): Episode
    {
        $episode = new Episode(
            new Id(null),
            new Id($data['seasonId']),
            new ValueObject($data['title']),
            new ValueObject($data['plot']),
            $data['episode'],
            new Carbon($data['aired']),
            $data['rating'],
            $data['votes'],
            $data['images'],
            $data['videos']
        );

        return $this->episodeRepository->save($episode);
    }

    /**
     * Delete the episode.
     *
     * @param Episode $episode
     * 
     * @return bool
     */
    public function delete(Episode $episode): bool
    {
        return $this->episodeRepository->delete($episode);
    }
}
