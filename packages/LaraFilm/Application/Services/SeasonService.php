<?php

namespace LaraFilm\Application\Services;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Models\Season\Season;
use LaraFilm\Domain\Models\Season\SeasonRepositoryInterface;
use LaraFilm\Interfaces\Services\SeasonServiceInterface;

/**
 * Class SeasonService
 *
 * @package LaraFilm\Application\Services
 */
class SeasonService implements SeasonServiceInterface
{
    /**
     * @var SeasonRepositoryInterface
     */
    private $seasonRepository;

    /**
     * SeasonService constructor.
     *
     * @param SeasonRepositoryInterface $seasonRepository
     */
    public function __construct(SeasonRepositoryInterface $seasonRepository)
    {
        $this->seasonRepository = $seasonRepository;
    }

    /**
     * Get all seasons.
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->seasonRepository->getAll();
    }

    /**
     * Find the season.
     *
     * @param string $id
     *
     * @return Season
     */
    public function findById(string $id): Season
    {
        return $this->seasonRepository->findById(new Id($id));
    }

    /**
     * Create the season.
     *
     * @param array $data
     *
     * @return Season
     */
    public function create(array $data): Season
    {
        $season = new Season(
            new Id(null),
            new Id($data['tvId']),
            $data['season'],
            new ValueObject($data['name']),
            new ValueObject($data['plot'])
        );

        return $this->seasonRepository->save($season);
    }

    /**
     * Delete the season.
     *
     * @param Season $season
     * 
     * @return bool
     */
    public function delete(Season $season): bool
    {
        return $this->seasonRepository->delete($season);
    }
}
