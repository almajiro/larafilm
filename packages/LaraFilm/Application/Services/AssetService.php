<?php

namespace LaraFilm\Application\Services;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Models\Asset\Asset;
use LaraFilm\Domain\Models\Asset\Type;
use LaraFilm\Domain\Models\Asset\AssetRepositoryInterface;
use LaraFilm\Interfaces\Services\AssetServiceInterface;

/**
 * Class AssetService
 *
 * @package LaraFilm\Application\Services
 */
class AssetService implements AssetServiceInterface
{
    /**
     * @var AssetRepositoryInterface
     */
    private $assetRepository;

    /**
     * AssetService constructor.
     *
     * @param AssetRepositoryInterface $assetRepository
     */
    public function __construct(AssetRepositoryInterface $assetRepository)
    {
        $this->assetRepository = $assetRepository;
    }

    /**
     * Get all assets.
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->assetRepository->getAll();
    }

    /**
     * Find the asset.
     *
     * @param string $id
     *
     * @return Asset
     */
    public function findById(string $id): Asset
    {
        return $this->assetRepository->findById(new Id($id));
    }

    /**
     * Create the asset.
     *
     * @param array $data
     *
     * @return Asset
     * @throws \LaraFilm\Domain\Exceptions\InvalidArgumentException
     */
    public function create(array $data): Asset
    {
        $asset = new Asset(
            new Id(null),
            new Type($data['type']),
            new ValueObject($data['extension'])
        );

        return $this->assetRepository->save($asset);
    }

    /**
     * Delete the asset.
     *
     * @param Asset $asset
     * 
     * @return bool
     */
    public function delete(Asset $asset): bool
    {
        return $this->assetRepository->delete($asset);
    }
}
