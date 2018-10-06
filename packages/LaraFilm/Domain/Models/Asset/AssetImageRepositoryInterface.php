<?php

namespace LaraFilm\Domain\Models\Asset;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\RepositoryInterface;
use LaraFilm\Domain\Models\Asset\Image;

/**
 * Interface AssetImageRepositoryInterface
 *
 * @package LaraFilm\Domain\Models\Asset
 */
interface AssetImageRepositoryInterface extends RepositoryInterface
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
     * @return \LaraFilm\Domain\Models\Asset\Image
     */
    public function findById(Id $id): Image;

    /**
     * Save the asset.
     *
     * @param \LaraFilm\Domain\Models\Asset\Image $image
     *
     * @return \LaraFilm\Domain\Models\Asset\Image
     */
    public function save(Image $image): Image;

    /**
     * Delete the asset.
     *
     * @param \LaraFilm\Domain\Models\Asset\Image $image
     *
     * @return bool
     */
    public function delete(Image $image): bool;
}
