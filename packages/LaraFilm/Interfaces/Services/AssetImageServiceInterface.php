<?php

namespace LaraFilm\Interfaces\Services;

use LaraFilm\Domain\Models\Asset\Image;

/**
 * Interface AssetImageServiceInterface
 *
 * @package LaraFilm\Interfaces\Services
 */
interface AssetImageServiceInterface
{
    /**
     * Return all images.
     *
     * @return \LaraFilm\Domain\Models\Asset\Image[]
     */
    public function getAll(): array;

    /**
     * Find the image.
     *
     * @param string $id
     *
     * @return \LaraFilm\Domain\Models\Asset\Image
     */
    public function findById(string $id): Image;

    /**
     * Create the image.
     *
     * @param string $assetId
     * @param int $type
     *
     * @return \LaraFilm\Domain\Models\Asset\Image
     */
    public function create(string $assetId, int $type): Image;

    /**
     * Delete the image.
     *
     * @param \LaraFilm\Domain\Models\Asset\Image $image
     *
     * @return bool
     */
    public function delete(Image $image): bool;
}
