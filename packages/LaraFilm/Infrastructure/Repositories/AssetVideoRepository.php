<?php

namespace LaraFilm\Infrastructure\Repositories;

use LaraFilm\Domain\Models\Asset\Video;
use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Models\Asset\Video as VideoEntity;
use LaraFilm\Domain\Models\Asset\AssetVideoRepositoryInterface;
use LaraFilm\Infrastructure\Persistence\AssetVideo;

/**
 * Class AssetVideoRepository
 *
 * @package LaraFilm\Infrastructure\Repositories
 */
class AssetVideoRepository implements AssetVideoRepositoryInterface
{
    /**
     * @var AssetVideo
     */
    private $assetPersistence;

    /**
     * AssetVideoRepository constructor.
     *
     * @param AssetVideo $assetPersistence
     */
    public function __construct(AssetVideo $assetPersistence)
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
     * @return VideoEntity
     * @throws \LaraFilm\Domain\Exceptions\InvalidArgumentException
     */
    public function findById(Id $id): VideoEntity
    {
        $assetPersistence = $this->assetPersistence->find($id->id());
        $asset = $assetPersistence->toEntity();

        return $asset;
    }

    /**
     * Save the asset.
     *
     * @param VideoEntity $asset
     *
     * @return VideoEntity
     * @throws \Exception
     */
    public function save(VideoEntity $asset): VideoEntity
    {
        $assetPersistence = $this->toPersistence($asset);
        $assetPersistence->save();

        $asset = $assetPersistence->toEntity();

        return $asset;
    }

    /**
     * Delete the asset.
     *
     * @param AssetVideo $asset
     *
     * @return bool
     * @throws \Exception
     */
    public function delete(VideoEntity $asset): bool
    {
        $assetPersistence = $this->toPersistence($asset);
        $assetPersistence->delete();

        return true;
    }

    /**
     * Convert Entity to Persistence.
     *
     * @param VideoEntity $entity
     *
     * @return AssetVideo
     * @throws \Exception
     */
    public function toPersistence($entity)
    {
        $primaryKey = $entity->id()->id();

        if (is_null($primaryKey)) {
            $assetPersistence = new AssetVideo();
        } else {
            $assetPersistence = $this->assetPersistence->find($primaryKey);
        }

        $assetPersistence->asset_uuid = $entity->asset()->id()->id();
        $assetPersistence->duration = $entity->duration();
        $assetPersistence->height = $entity->height();
        $assetPersistence->width = $entity->width();
        $assetPersistence->aspect_ratio = $entity->aspectRatio()->value();
        $assetPersistence->fps = $entity->fps();
        $assetPersistence->chapter = '{}';

        return $assetPersistence;
    }
}
