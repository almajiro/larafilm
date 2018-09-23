<?php

namespace LaraFilm\Interfaces\Services;

use LaraFilm\Domain\Models\Person\Person;

/**
 * Interface PersonServiceInterface
 *
 * @package LaraFilm\Interfaces\Services
 */
interface PersonServiceInterface
{
    /**
     * Return all persons.
     *
     * @return \LaraFilm\Domain\Models\Person\Person[]
     */
    public function getAll(): array;

    /**
     * Find the person.
     *
     * @param string $id
     *
     * @return \LaraFilm\Domain\Models\Person\Person
     */
    public function findById(string $id): Person;

    /**
     * Create the person.
     *
     * @param string $name
     *
     * @return \LaraFilm\Domain\Models\Person\Person
     */
    public function create(string $name): Person;

    /**
     * Delete the person.
     *
     * @param Person $person
     *
     * @return bool
     */
    public function delete(Person $person): bool;
}
