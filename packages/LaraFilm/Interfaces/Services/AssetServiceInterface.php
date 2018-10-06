<?php

namespace LaraFilm\Interfaces\Services;

use LaraFilm\Domain\Models\Asset\Asset;

/**
 * Interface AssetServiceInterface
 *
 * @package LaraFilm\Interfaces\Services
 */
interface AssetServiceInterface
{
    /**
     * Return all assets.
     *
     * @return \LaraFilm\Domain\Models\Asset\Asset[]
     */
    public function getAll(): array;

    /**
     * Find the asset.
     *
     * @param string $id
     *
     * @return \LaraFilm\Domain\Models\Asset\Asset
     */
    public function findById(string $id): Asset;

    /**
     * Create the asset.
     *
     * @param array $data
     *
     * @return \LaraFilm\Domain\Models\Asset\Asset
     */
    public function create(array $data): Asset;

    /**
     * Delete the asset.
     *
     * @param Asset $asset
     *
     * @return \LaraFilm\Domain\Models\Asset\Asset
     */
    public function delete(Asset $asset): bool;
}
