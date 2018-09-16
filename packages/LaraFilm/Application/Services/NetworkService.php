<?php

namespace LaraFilm\Application\Services;

use LaraFilm\Domain\Models\Network\Network;
use LaraFilm\Interfaces\Services\NetworkServiceInterface;
use LaraFilm\Domain\Models\Network\NetworkRepositoryInterface;

/**
 * Class NetworkService
 *
 * @package LaraFilm\Application\Services
 */
class NetworkService implements NetworkServiceInterface
{
    /**
     * @var NetworkRepositoryInterface
     */
    private $networkRepository;

    /**
     * NetworkService constructor.
     *
     * @param NetworkRepositoryInterface $networkRepository
     */
    public function __construct(NetworkRepositoryInterface $networkRepository)
    {
        $this->networkRepository = $networkRepository;
    }

    /**
     * Get all networks.
     *
     * This function return all networks.
     *
     * @return Network[]
     */
    public function getAll(): array
    {
        return $this->networkRepository->getAll();
    }
}
