<?php

namespace LaraFilm\Application\Services;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Models\Person\Person;
use LaraFilm\Domain\Models\Person\PersonRepositoryInterface;
use LaraFilm\Interfaces\Services\PersonServiceInterface;

/**
 * Class PersonService
 *
 * @package LaraFilm\Application\Services
 */
class PersonService implements PersonServiceInterface
{
    /**
     * @var PersonRepositoryInterface
     */
    private $personRepository;

    /**
     * PersonService constructor.
     *
     * @param PersonRepositoryInterface $personRepository
     */
    public function __construct(PersonRepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    /**
     * Get all person.
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->personRepository->getAll();
    }

    /**
     * Find the person.
     *
     * @param string $id
     *
     * @return Person
     */
    public function findById(string $id): Person
    {
        return $this->personRepository->findById(new Id($id));
    }

    /**
     * Create the person.
     *
     * @param string $name
     *
     * @return Person
     */
    public function create(string $name): Person
    {
        $person = new Person(
            new Id(null),
            new ValueObject($name)
        );

        return $this->personRepository->save($person);
    }

    /**
     * Delete the person.
     *
     * @param Person $person
     *
     * @return bool
     */
    public function delete(Person $person): bool
    {
        return $this->personRepository->delete($person);
    }
}
