<?php

namespace LaraFilm\Application\Services;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Models\Genre\Genre;
use LaraFilm\Domain\Models\Genre\GenreRepositoryInterface;
use LaraFilm\Interfaces\Services\GenreServiceInterface;

/**
 * Class GenreService
 *
 * @package LaraFilm\Application\Services
 */
class GenreService implements GenreServiceInterface
{
    /**
     * @var GenreRepositoryInterface
     */
    private $genreRepository;

    /**
     * GenreService constructor.
     *
     * @param GenreRepositoryInterface $genreRepository
     */
    public function __construct(GenreRepositoryInterface $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    /**
     * Get all genres.
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->genreRepository->getAll();
    }

    /**
     * Find the genre.
     *
     * @param string $id
     *
     * @return Genre
     */
    public function findById(string $id): Genre
    {
        return $this->genreRepository->findById(new Id($id));
    }

    /**
     * Create the genre.
     *
     * @param string $name
     *
     * @return Genre
     */
    public function create(string $name): Genre
    {
        $genre = new Genre(
            new Id(null),
            new ValueObject($name)
        );

        return $this->genreRepository->save($genre);
    }

    /**
     * Delete the genre.
     *
     * @param Genre $genre
     * 
     * @return bool
     */
    public function delete(Genre $genre): bool
    {
        return $this->genreRepository->delete($genre);
    }
}
