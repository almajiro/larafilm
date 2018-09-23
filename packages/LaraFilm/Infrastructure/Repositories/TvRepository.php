<?php

namespace LaraFilm\Infrastructure\Repositories;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Models\Tv\Tv as TvEntity;
use LaraFilm\Domain\Models\Tv\TvRepositoryInterface;
use LaraFilm\Infrastructure\Persistence\Tv;

/**
 * Class TvRepository
 *
 * @package LaraFilm\Infrastructure\Repositories
 */
class TvRepository implements TvRepositoryInterface
{
    /**
     * @var Tv
     */
    private $tvPersistence;

    /**
     * TvRepository constructor.
     *
     * @param Tv $tvPersistence
     */
    public function __construct(Tv $tvPersistence)
    {
        $this->tvPersistence = $tvPersistence;
    }

    /**
     * Return all tv shows.
     *
     * @return TvEntity[]
     */
    public function getAll(): array
    {
        $tvPersistences = $this->tvPersistence->all();
        $tvs = [];

        foreach ($tvPersistences as $tv) {
            $tvs[] = $tv->toEntity();
        }

        return $tvs;
    }

    /**
     * Find the tv show.
     *
     * @param Id $id
     *
     * @return TvEntity
     */
    public function findById(Id $id): TvEntity
    {
        $tvPersistence = $this->tvPersistence->find($id->id());
        $tv = $tvPersistence->toEntity();

        return $tv;
    }

    /**
     * Save the tv show.
     *
     * @param TvEntity $tv
     *
     * @return TvEntity
     * @throws \Exception
     */
    public function save(TvEntity $tv): TvEntity
    {
        $tvPersistence = $this->toPersistence($tv);
        $tvPersistence->save();

        $tv = $tvPersistence->toEntity();

        return $tv;
    }

    /**
     * Delete the tv show.
     *
     * @param TvEntity $tv
     *
     * @return bool
     * @throws \Exception
     */
    public function delete(TvEntity $tv): bool
    {
        $tvPersistence = $this->toPersistence($tv);
        $tvPersistence->delete();

        return true;
    }

    /**
     * Convert Entity to Persistence.
     *
     * @param \LaraFilm\Domain\Models\Tv\Tv $entity
     *
     * @return Tv
     * @throws \Exception
     */
    public function toPersistence($entity)
    {
        $primaryKey = $entity->id()->id();

        if (is_null($primaryKey)) {
            $tvPersistence = new Tv();
        } else {
            $tvPersistence = $this->tvPersistence->find($primaryKey);
        }

        $tvPersistence->name = $entity->name()->value();
        $tvPersistence->plot = $entity->plot()->value();
        $tvPersistence->mpaa = $entity->mpaa()->value();
        $tvPersistence->year = $entity->year();
        $tvPersistence->rating = $entity->rating();
        $tvPersistence->votes = $entity->votes();
        $tvPersistence->status = $entity->status()->status();

        $studios = [];
        $genres = [];
        $actors = [];

        foreach ($entity->studios() as $studio) {
            $studios[] = $studio->id()->id();
        }

        foreach ($entity->genres() as $genre) {
            $genres[] = $genre->id()->id();
        }

        foreach ($entity->actors() as $actor) {
            $actors[] = $actor->id()->id();
        }

        $tvPersistence->studios()->sync($studios);
        $tvPersistence->genres()->sync($genres);
        $tvPersistence->actors()->sync($actors);

        return $tvPersistence;
    }
}
