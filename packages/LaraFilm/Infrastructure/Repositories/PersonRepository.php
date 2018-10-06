<?php

namespace LaraFilm\Infrastructure\Repositories;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Models\Person\Person as PersonEntity;
use LaraFilm\Domain\Models\Person\PersonRepositoryInterface;
use LaraFilm\Infrastructure\Persistence\Person;

/**
 * Class PersonRepository
 *
 * @package LaraFilm\Infrastructure\Repositories
 */
class PersonRepository implements  PersonRepositoryInterface
{
    /**
     * @var Person
     */
    private $personPersistence;

    /**
     * PersonRepository constructor.
     *
     * @param Person $personPersistence
     */
    public function __construct(Person $personPersistence)
    {
        $this->personPersistence = $personPersistence;
    }

    /**
     * Return all person.
     *
     * @return array
     */
    public function getAll(): array
    {
        $personPersistences = $this->personPersistence->all();
        $persons = [];

        foreach ($personPersistences as $person) {
            $persons[] = $person->toEntity();
        }

        return $persons;
    }

    /**
     * Find the person.
     *
     * @param Id $id
     *
     * @return PersonEntity
     * @throws \Exception
     */
    public function findById(Id $id): PersonEntity
    {
        $personPersistence = $this->personPersistence->find($id->id());
        $person = $personPersistence->toEntity();

        return $person;
    }

    /**
     * Save the person.
     *
     * @param PersonEntity $person
     *
     * @return PersonEntity
     * @throws \Exception
     */
    public function save(PersonEntity $person): PersonEntity
    {
        $personPersistence = $this->toPersistence($person);
        $personPersistence->save();

        $person = $personPersistence->toEntity();

        return $person;
    }

    /**
     * Delete the person.
     *
     * @param PersonEntity $person
     *
     * @return bool
     * @throws \Exception
     */
    public function delete(PersonEntity $person): bool
    {
        $personPersistence = $this->toPersistence($person);
        $personPersistence->delete();

        return true;
    }

    /**
     * Convert Entity to Persistence.
     *
     * @param PersonEntity $entity
     *
     * @return Person
     * @throws \Exception
     */
    public function toPersistence($entity)
    {
        $primaryKey = $entity->id()->id();

        if (is_null($primaryKey)) {
            $personPersistence = new Person();
        } else {
            $personPersistence = $this->personPersistence->find($primaryKey);
        }

        $personPersistence->name = $entity->name()->value();

        $images = [];
        foreach ($entity->images() as $image) {
            $images[] = $image->id()->id();
        }

        $personPersistence->images()->sync($images);

        return $personPersistence;
    }
}
