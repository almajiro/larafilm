<?php

namespace LaraFilm\Infrastructure\Repositories;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Models\Genre\Genre as GenreEntity;
use LaraFilm\Domain\Models\Genre\GenreRepositoryInterface;
use LaraFilm\Infrastructure\Persistence\Genre;

/**
 * Class GenreRepository
 *
 * @package LaraFilm\Infrastructure\Repositories
 */
class GenreRepository implements GenreRepositoryInterface
{
    /**
     * @var Genre
     */
    private $genrePersistence;

    /**
     * GenreRepository constructor.
     *
     * @param Genre $genrePersistence
     */
    public function __construct(Genre $genrePersistence)
    {
        $this->genrePersistence = $genrePersistence;
    }

    /**
     * Return all genres.
     *
     * @return array
     */
    public function getAll(): array
    {
        $genrePersistences = $this->genrePersistence->all();
        $genres = [];

        foreach ($genrePersistences as $genre) {
            $genres[] = $genre->toEntity();
        }

        return $genres;
    }

    /**
     * Find the genre.
     *
     * @param Id $id
     *
     * @return GenreEntity
     */
    public function findById(Id $id): GenreEntity
    {
        $genrePersistence = $this->genrePersistence->find($id->id());
        $genre = $genrePersistence->toEntity();

        return $genre;
    }

    /**
     * Save the genre.
     *
     * @param GenreEntity $genre
     *
     * @return GenreEntity
     * @throws \Exception
     */
    public function save(GenreEntity $genre): GenreEntity
    {
        $genrePersistence = $this->toPersistence($genre);
        $genrePersistence->save();

        $genre = $genrePersistence->toEntity();

        return $genre;
    }

    /**
     * Delete the genre.
     *
     * @param GenreEntity $genre
     *
     * @return bool
     * @throws \Exception
     */
    public function delete(GenreEntity $genre): bool
    {
        $genrePersistence = $this->toPersistence($genre);
        $genrePersistence->delete();

        return true;
    }

    /**
     * Convert Entity to Persistence.
     *
     * @param GenreEntity $entity
     *
     * @return Genre
     * @throws \Exception
     */
    public function toPersistence($entity)
    {
        $primaryKey = $entity->id()->id();

        if (is_null($primaryKey)) {
            $genrePersistence = new Genre();
        } else {
            $genrePersistence = $this->genrePersistence->find($primaryKey);
        }

        $genrePersistence->name = $entity->name()->value();

        return $genrePersistence;
    }
}
