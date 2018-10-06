<?php

namespace LaraFilm\Application\Services;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Models\Person\Person;
use LaraFilm\Domain\Models\Person\PersonRepositoryInterface;
use LaraFilm\Domain\Models\Asset\AssetImageRepositoryInterface;
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

    private $assetImageRepository;

    /**
     * PersonService constructor.
     *
     * @param PersonRepositoryInterface $personRepository
     */
    public function __construct(
        PersonRepositoryInterface $personRepository,
        AssetImageRepositoryInterface $assetImageRepository
    ) {
        $this->personRepository = $personRepository;
        $this->assetImageRepository = $assetImageRepository;
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
     * @param array $data
     *
     * @return Person
     */
    public function create(array $data): Person
    {
        $images = [];

        foreach ($data['images'] as $image) {
            $images[] = $this->assetImageRepository->findById(new Id($image));
        }

        $person = new Person(
            new Id(null),
            new ValueObject($data['name']),
            $images
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
