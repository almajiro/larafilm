<?php

namespace LaraFilm\Infrastructure\Repositories;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Models\Season\Season as SeasonEntity;
use LaraFilm\Domain\Models\Season\SeasonRepositoryInterface;
use LaraFilm\Infrastructure\Persistence\Season;

/**
 * Class SeasonRepository
 *
 * @package LaraFilm\Infrastructure\Repositories
 */
class SeasonRepository implements SeasonRepositoryInterface
{
    /**
     * @var Season
     */
    private $seasonPersistence;

    /**
     * SeasonRepository constructor.
     *
     * @param Season $seasonPersistence
     */
    public function __construct(Season $seasonPersistence)
    {
        $this->seasonPersistence = $seasonPersistence;
    }

    /**
     * Return all seasons.
     *
     * @return array
     */
    public function getAll(): array
    {
        $seasonPersistences = $this->seasonPersistence->all();
        $seasons = [];

        foreach ($seasonPersistences as $season) {
            $seasons[] = $season->toEntity();
        }

        return $seasons;
    }

    /**
     * Find the season.
     *
     * @param Id $id
     *
     * @return SeasonEntity
     */
    public function findById(Id $id): SeasonEntity
    {
        $seasonPersistence = $this->seasonPersistence->find($id->id());
        $season = $seasonPersistence->toEntity();

        return $season;
    }

    /**
     * Save the season.
     *
     * @param SeasonEntity $season
     *
     * @return SeasonEntity
     * @throws \Exception
     */
    public function save(SeasonEntity $season): SeasonEntity
    {
        $seasonPersistence = $this->toPersistence($season);
        $seasonPersistence->save();

        $season = $seasonPersistence->toEntity();

        return $season;
    }

    /**
     * Delete the season.
     *
     * @param SeasonEntity $season
     *
     * @return bool
     * @throws \Exception
     */
    public function delete(SeasonEntity $season): bool
    {
        $seasonPersistence = $this->toPersistence($season);
        $seasonPersistence->delete();

        return true;
    }

    /**
     * Convert Entity to Persistence.
     *
     * @param SeasonEntity $entity
     *
     * @return Season
     * @throws \Exception
     */
    public function toPersistence($entity)
    {
        $primaryKey = $entity->id()->id();

        if (is_null($primaryKey)) {
            $seasonPersistence = new Season();
        } else {
            $seasonPersistence = $this->seasonPersistence->find($primaryKey);
        }

        $seasonPersistence->name = $entity->name()->value();
        $seasonPersistence->season = $entity->season();
        $seasonPersistence->tv_uuid = $entity->tvId()->id();

        return $seasonPersistence;
    }
}
