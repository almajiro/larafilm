<?php

namespace LaraFilm\Interfaces\Services;

use LaraFilm\Domain\Models\Asset\Video;

/**
 * Interface AssetVideoServiceInterface
 *
 * @package LaraFilm\Interfaces\Services
 */
interface AssetVideoServiceInterface
{
    /**
     * Return all videos.
     *
     * @return \LaraFilm\Domain\Models\Asset\Video[]
     */
    public function getAll(): array;

    /**
     * Find the video.
     *
     * @param string $id
     *
     * @return \LaraFilm\Domain\Models\Asset\Video
     */
    public function findById(string $id): Video;

    /**
     * Create the video.
     *
     * @param array $data
     * @param int $type
     *
     * @return \LaraFilm\Domain\Models\Asset\Video
     */
    public function create(array $data): Video;

    /**
     * Delete the video.
     *
     * @param \LaraFilm\Domain\Models\Asset\Video $video
     *
     * @return bool
     */
    public function delete(Video $video): bool;
}
