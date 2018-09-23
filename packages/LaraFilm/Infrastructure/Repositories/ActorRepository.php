<?php

namespace LaraFilm\Infrastructure\Repositories;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Models\Actor\Actor as ActorEntity;
use LaraFilm\Domain\Models\Actor\ActorRepositoryInterface;
use LaraFilm\Infrastructure\Persistence\Actor;

/**
 * Class ActorRepository
 *
 * @package LaraFilm\Infrastructure\Repositories
 */
class ActorRepository implements ActorRepositoryInterface
{
    /**
     * @var Actor
     */
    private $actorPersistence;

    /**
     * ActorRepository constructor.
     *
     * @param Actor $actorPersistence
     */
    public function __construct(Actor $actorPersistence)
    {
        $this->actorPersistence = $actorPersistence;
    }

    /**
     * Return all actors.
     *
     * @return array
     */
    public function getAll(): array
    {
        $actorPersistences = $this->actorPersistence->all();
        $actors = [];

        foreach ($actorPersistences as $actor) {
            $actors[] = $actor->toEntity();
        }

        return $actors;
    }

    /**
     * Find the actor.
     *
     * @param Id $id
     *
     * @return ActorEntity
     */
    public function findById(Id $id): ActorEntity
    {
        $actorPersistence = $this->actorPersistence->find($id->id());
        $actor = $actorPersistence->toEntity();

        return $actor;
    }

    /**
     * Save the actor.
     *
     * @param ActorEntity $actor
     *
     * @return ActorEntity
     * @throws \Exception
     */
    public function save(ActorEntity $actor): ActorEntity
    {
        $actorPersistence = $this->toPersistence($actor);
        $actorPersistence->save();

        $actor = $actorPersistence->toEntity();

        return $actor;
    }

    /**
     * Delete the actor.
     *
     * @param ActorEntity $actor
     *
     * @return bool
     * @throws \Exception
     */
    public function delete(ActorEntity $actor): bool
    {
        $actorPersistence = $this->toPersistence($actor);
        $actorPersistence->delete();

        return true;
    }

    /**
     * Convert Actor Entity to Persistence
     *
     * @param ActorEntity $entity
     *
     * @return Actor
     * @throws \Exception
     */
    public function toPersistence($entity): Actor
    {
        $primaryKey = $entity->id()->id();

        if (is_null($primaryKey)) {
            $actorPersistence = new Actor();
        } else {
            $actorPersistence = $this->actorPersistence->find($primaryKey);
        }

        $actorPersistence->person_uuid = $entity->person()->id()->id();
        $actorPersistence->role = $entity->role()->value();

        return $actorPersistence;
    }


}
