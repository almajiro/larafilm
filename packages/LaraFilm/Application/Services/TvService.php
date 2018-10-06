<?php

namespace LaraFilm\Application\Services;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Models\Tv\Tv;
use LaraFilm\Domain\Models\Tv\Status;
use LaraFilm\Domain\Models\Tv\TvRepositoryInterface;
use LaraFilm\Interfaces\Services\TvServiceInterface;

/**
 * Class TvService
 *
 * @package LaraFilm\Application\Services
 */
class TvService implements TvServiceInterface
{
    /**
     * @var TvRepositoryInterface
     */
    private $tvRepository;

    /**
     * TvService constructor.
     *
     * @param TvRepositoryInterface $tvRepository
     */
    public function __construct(TvRepositoryInterface $tvRepository)
    {
        $this->tvRepository = $tvRepository;
    }

    /**
     * Return all Tvs.
     *
     * @return Tv[]
     */
    public function getAll(): array
    {
        return $this->tvRepository->getAll();
    }

    /**
     * Find the tv show.
     *
     * @param string $id
     * @return Tv
     */
    public function findById(string $id): Tv
    {
        return $this->tvRepository->findById(new Id($id));
    }

    /**
     * Create the tv show.
     *
     * @param array $data
     * @return Tv
     */
    public function create(array $data): Tv
    {
        $tv = new Tv(
            new Id(null),
            new ValueObject($data['name']),
            new ValueObject($data['plot']),
            new ValueObject($data['mpaa']),
            $data['year'],
            new Status($data['status']),
            $data['rating'],
            $data['votes'],
            $data['genres'],
            $data['studios'],
            $data['actors'],
            $data['images']
        );

        return $this->tvRepository->save($tv);
    }

    /**
     * Delete the tv show.
     *
     * @param Tv $tv
     * @return bool
     */
    public function delete(Tv $tv): bool
    {
        return $this->tvRepository->delete($tv);
    }
}
