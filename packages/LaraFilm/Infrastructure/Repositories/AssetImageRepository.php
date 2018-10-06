<?php

namespace LaraFilm\Infrastructure\Repositories;

use LaraFilm\Domain\Models\Asset\Image;
use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Models\Asset\Image as ImageEntity;
use LaraFilm\Domain\Models\Asset\AssetImageRepositoryInterface;
use LaraFilm\Infrastructure\Persistence\AssetImage;

/**
 * Class AssetImageRepository
 *
 * @package LaraFilm\Infrastructure\Repositories
 */
class AssetImageRepository implements AssetImageRepositoryInterface
{
    /**
     * @var AssetImage
     */
    private $assetPersistence;

    /**
     * AssetImageRepository constructor.
     *
     * @param AssetImage $assetPersistence
     */
    public function __construct(AssetImage $assetPersistence)
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
     * @return ImageEntity
     * @throws \LaraFilm\Domain\Exceptions\InvalidArgumentException
     */
    public function findById(Id $id): ImageEntity
    {
        $assetPersistence = $this->assetPersistence->find($id->id());
        $asset = $assetPersistence->toEntity();

        return $asset;
    }

    /**
     * Save the asset.
     *
     * @param ImageEntity $asset
     *
     * @return ImageEntity
     * @throws \Exception
     */
    public function save(ImageEntity $asset): ImageEntity
    {
        $assetPersistence = $this->toPersistence($asset);
        $assetPersistence->save();

        $asset = $assetPersistence->toEntity();

        return $asset;
    }

    /**
     * Delete the asset.
     *
     * @param AssetImage $asset
     *
     * @return bool
     * @throws \Exception
     */
    public function delete(ImageEntity $asset): bool
    {
        $assetPersistence = $this->toPersistence($asset);
        $assetPersistence->delete();

        return true;
    }

    /**
     * Convert Entity to Persistence.
     *
     * @param ImageEntity $entity
     *
     * @return AssetImage
     * @throws \Exception
     */
    public function toPersistence($entity)
    {
        $primaryKey = $entity->id()->id();

        if (is_null($primaryKey)) {
            $assetPersistence = new AssetImage();
        } else {
            $assetPersistence = $this->assetPersistence->find($primaryKey);
        }

        $assetPersistence->asset_uuid = $entity->asset()->id()->id();
        $assetPersistence->type = $entity->type();

        return $assetPersistence;
    }
}
