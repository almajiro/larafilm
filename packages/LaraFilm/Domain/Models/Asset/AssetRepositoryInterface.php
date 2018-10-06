<?php

namespace LaraFilm\Domain\Models\Asset;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\RepositoryInterface;
use LaraFilm\Domain\Models\Asset\Asset;

/**
 * Interface AssetRepositoryInterface
 *
 * @package LaraFilm\Domain\Models\Asset
 */
interface AssetRepositoryInterface extends RepositoryInterface
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
     * @return \LaraFilm\Domain\Models\Asset\Asset
     */
    public function findById(Id $id): Asset;

    /**
     * Save the asset.
     *
     * @param \LaraFilm\Domain\Models\Asset\Asset $asset
     *
     * @return \LaraFilm\Domain\Models\Asset\Asset
     */
    public function save(Asset $asset): Asset;

    /**
     * Delete the asset.
     *
     * @param \LaraFilm\Domain\Models\Asset\Asset $asset
     *
     * @return bool
     */
    public function delete(Asset $asset): bool;
}
