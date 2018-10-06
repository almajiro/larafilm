<?php

namespace LaraFilm\Domain\Models\Asset;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\RepositoryInterface;
use LaraFilm\Domain\Models\Asset\Video;

/**
 * Interface AssetVideoRepositoryInterface
 *
 * @package LaraFilm\Domain\Models\Asset
 */
interface AssetVideoRepositoryInterface extends RepositoryInterface
{
    /**
     * Return all assets.
     *
     * @return array
     */
    public function getAll(): array;

    /**
     * Find the asset.
     *
     * @param Id $id
     *
     * @return \LaraFilm\Domain\Models\Asset\Video
     */
    public function findById(Id $id): Video;

    /**
     * Save the asset.
     *
     * @param \LaraFilm\Domain\Models\Asset\Video $image
     *
     * @return \LaraFilm\Domain\Models\Asset\Video
     */
    public function save(Video $image): Video;

    /**
     * Delete the asset.
     *
     * @param \LaraFilm\Domain\Models\Asset\Video $image
     *
     * @return bool
     */
    public function delete(Video $image): bool;
}
