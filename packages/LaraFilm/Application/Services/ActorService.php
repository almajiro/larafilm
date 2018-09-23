<?php

namespace LaraFilm\Application\Services;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Models\Actor\Actor;
use LaraFilm\Interfaces\Services\ActorServiceInterface;
use LaraFilm\Domain\Models\Actor\ActorRepositoryInterface;
use LaraFilm\Domain\Models\Person\PersonRepositoryInterface;

/**
 * Class ActorService
 *
 * @package LaraFilm\Application\Services
 */
class ActorService implements  ActorServiceInterface
{
    /**
     * @var ActorRepositoryInterface
     */
    private $actorRepository;

    /**
     * @var PersonRepositoryInterface
     */
    private $personRepository;

    /**
     * ActorService constructor.
     *
     * @param ActorRepositoryInterface $actorRepository
     * @param PersonRepositoryInterface $personRepository
     */
    public function __construct(
        ActorRepositoryInterface $actorRepository,
        PersonRepositoryInterface $personRepository
    ) {
        $this->actorRepository = $actorRepository;
        $this->personRepository = $personRepository;
    }

    /**
     * Return all actors.
     *
     * @return \LaraFilm\Domain\Models\Actor\Actor[]
     */
    public function getAll(): array
    {
        return $this->actorRepository->getAll();
    }

    /**
     * Find the actor.
     *
     * @param string $id
     *
     * @return \LaraFilm\Domain\Models\Actor\Actor
     */
    public function findById(string $id): Actor
    {
        return $this->actorRepository->findById(new Id($id));
    }

    /**
     * Create the actor.
     *
     * @param string $personId
     * @param string $role
     *
     * @return \LaraFilm\Domain\Models\Actor\Actor
     */
    public function create(string $personId, string $role): Actor
    {
        $actor = new Actor(
            new Id(null),
            $this->personRepository->findById(new Id($personId)),
            new ValueObject($role)
        );

        return $this->actorRepository->save($actor);
    }

    /**
     * Delete the actor.
     *
     * @param \LaraFilm\Domain\Models\Actor\Actor $actor
     *
     * @return bool
     */
    public function delete(Actor $actor): bool
    {
        return $this->actorRepository->delete($actor);
    }
}
