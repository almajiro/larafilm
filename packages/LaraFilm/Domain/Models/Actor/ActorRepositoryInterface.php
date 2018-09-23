<?php

namespace LaraFilm\Domain\Models\Actor;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Models\Actor\Actor;
use LaraFilm\Domain\Shared\RepositoryInterface;

/**
 * Interface ActorRepositoryInterface
 *
 * @package LaraFilm\Domain\Models\Actor
 */
interface ActorRepositoryInterface extends RepositoryInterface
{
    /**
     * Return all actors.
     *
     * @return array
     */
    public function getAll(): array;

    /**
     * Find the actor.
     *
     * @param Id $id
     *
     * @return \LaraFilm\Domain\Models\Actor\Actor
     */
    public function findById(Id $id): Actor;

    /**
     * Save the actor.
     *
     * @param \LaraFilm\Domain\Models\Actor\Actor $actor
     *
     * @return \LaraFilm\Domain\Models\Actor\Actor
     */
    public function save(Actor $actor): Actor;

    /**
     * Delete the actor.
     *
     * @param \LaraFilm\Domain\Models\Actor\Actor $actor
     *
     * @return bool
     */
    public function delete(Actor $actor): bool;
}
