<?php

namespace LaraFilm\Domain\Models\Person;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\RepositoryInterface;
use LaraFilm\Domain\Models\Person\Person;

/**
 * Interface PersonRepositoryInterface
 *
 * @package LaraFilm\Domain\Models\Person
 */
interface PersonRepositoryInterface extends RepositoryInterface
{
    /**
     * Return all persons.
     *
     * @return array
     */
    public function getAll(): array;

    /**
     * Find the person.
     *
     * @param Id $id
     *
     * @return \LaraFilm\Domain\Models\Person\Person
     */
    public function findById(Id $id): Person;

    /**
     * Save the person.
     *
     * @param \LaraFilm\Domain\Models\Person\Person $person
     *
     * @return \LaraFilm\Domain\Models\Person\Person
     */
    public function save(Person $person): Person;

    /**
     * Delete the person.
     *
     * @param \LaraFilm\Domain\Models\Person\Person $person
     *
     * @return bool
     */
    public function delete(Person $person): bool;
}
