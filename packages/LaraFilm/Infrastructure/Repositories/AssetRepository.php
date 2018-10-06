<?php

namespace LaraFilm\Infrastructure\Repositories;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Models\Asset\Asset as AssetEntity;
use LaraFilm\Domain\Models\Asset\AssetRepositoryInterface;
use LaraFilm\Infrastructure\Persistence\Asset;

/**
 * Class AssetRepository
 *
 * @package LaraFilm\Infrastructure\Repositories
 */
class AssetRepository implements AssetRepositoryInterface
{
    /**
     * @var Asset
     */
    private $assetPersistence;

    /**
     * AssetRepository constructor.
     *
     * @param Asset $assetPersistence
     */
    public function __construct(Asset $assetPersistence)
    {
        $this->assetPersistence = $assetPersistence;
    }

    /**
     * Return all assets.
     *
     * @return array
     */
    public function getAll(): array
    {
        $assetPersistences = $this->assetPersistence->all();
        $assets = [];

        foreach ($assetPersistences as $asset) {
            $assets[] = $asset->toEntity();
        }

        return $assets;
    }

    /**
     * Find the asset.
     *
     * @param Id $id
     *
     * @return AssetEntity
     * @throws \LaraFilm\Domain\Exceptions\InvalidArgumentException
     */
    public function findById(Id $id): AssetEntity
    {
        $assetPersistence = $this->assetPersistence->find($id->id());
        $asset = $assetPersistence->toEntity();

        return $asset;
    }

    /**
     * Save the asset.
     *
     * @param AssetEntity $asset
     *
     * @return AssetEntity
     * @throws \Exception
     */
    public function save(AssetEntity $asset): AssetEntity
    {
        $assetPersistence = $this->toPersistence($asset);
        $assetPersistence->save();

        $asset = $assetPersistence->toEntity();

        return $asset;
    }

    /**
     * Delete the asset.
     *
     * @param AssetEntity $asset
     *
     * @return bool
     * @throws \Exception
     */
    public function delete(AssetEntity $asset): bool
    {
        $assetPersistence = $this->toPersistence($asset);
        $assetPersistence->delete();

        return true;
    }

    /**
     * Convert Entity to Persistence.
     *
     * @param AssetEntity $entity
     *
     * @return Asset
     * @throws \Exception
     */
    public function toPersistence($entity)
    {
        $primaryKey = $entity->id()->id();

        if (is_null($primaryKey)) {
            $assetPersistence = new Asset();
        } else {
            $assetPersistence = $this->assetPersistence->find($primaryKey);
        }

        $assetPersistence->file_type = $entity->fileType()->type();
        $assetPersistence->extension = $entity->extension()->value();

        return $assetPersistence;
    }
}
