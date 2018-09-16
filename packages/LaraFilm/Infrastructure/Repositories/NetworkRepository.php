<?php

namespace LaraFilm\Infrastructure\Repositories;

use Carbon\Carbon;
use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Models\Network\Network as NetworkEntity;
use LaraFilm\Domain\Models\Network\NetworkRepositoryInterface;
use LaraFilm\Infrastructure\Persistence\Network;

/**
 * Class NetworkRepository
 *
 * @package LaraFilm\Infrastructure\Repositories
 */
class NetworkRepository implements NetworkRepositoryInterface
{
    /**
     * @var Network
     */
    private $networkPersistence;

    /**
     * NetworkRepository constructor.
     *
     * @param Network $networkPersistence
     */
    public function __construct(Network $networkPersistence)
    {
        $this->networkPersistence = $networkPersistence;
    }

    /**
     * Return all networks.
     *
     * @return NetworkEntity[]
     */
    public function getAll(): array
    {
        $networkPersistences = $this->networkPersistence->all();
        $networks = [];

        foreach ($networkPersistences as $persistence) {
            $networks[] = $this->toEntity($persistence);
        }

        return $networks;
    }

    /**
     * Convert Persistence to Network Entity.
     *
     * @param $persistence
     *
     * @return NetworkEntity
     */
    public function toEntity($persistence): NetworkEntity
    {
        return new NetworkEntity(
            new Id($persistence->id),
            new ValueObject($persistence->name),
            new ValueObject($persistence->description),
            $persistence->headquarters,
            $persistence->origin_country,
            $persistence->created_at ? new Carbon($persistence->created_at) : null,
            $persistence->updated_at ? new Carbon($persistence->updated_at) : null
        );
    }

    /**
     * Convert Entity to Persistence.
     *
     * @param $entity
     * @return Network
     */
    public function toPersistence($entity): Network
    {
        // TODO: Implement toPersistence() method.
    }
}
