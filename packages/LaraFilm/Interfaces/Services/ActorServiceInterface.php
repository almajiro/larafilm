<?php

namespace LaraFilm\Interfaces\Services;

use LaraFilm\Domain\Models\Actor\Actor;

/**
 * Interface ActorServiceInterface
 *
 * @package LaraFilm\Interfaces\Services
 */
interface ActorServiceInterface
{
    /**
     * Return all actors.
     *
     * @return \LaraFilm\Domain\Models\Actor\Actor[]
     */
    public function getAll(): array;

    /**
     * Find the actor.
     *
     * @param string $id
     *
     * @return \LaraFilm\Domain\Models\Actor\Actor
     */
    public function findById(string $id): Actor;


    /**
     * Create the actor.
     *
     * @param string $personId
     * @param string $role
     *
     * @return \LaraFilm\Domain\Models\Actor\Actor
     */
    public function create(string $personId, string $role): Actor;

    /**
     * Delete the actor.
     *
     * @param \LaraFilm\Domain\Models\Actor\Actor $actor
     *
     * @return bool
     */
    public function delete(Actor $actor): bool;
}
