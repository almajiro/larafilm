<?php

namespace LaraFilm\Application\Services;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Models\Asset\Video;
use LaraFilm\Domain\Models\Asset\AssetRepositoryInterface;
use LaraFilm\Domain\Models\Asset\AssetVideoRepositoryInterface;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Interfaces\Services\AssetVideoServiceInterface;

/**
 * Class AssetVideoService
 *
 * @package LaraFilm\Application\Services
 */
class AssetVideoService implements AssetVideoServiceInterface
{
    private $assetRepository;

    /**
     * @var AssetVideoRepositoryInterface
     */
    private $videoRepository;

    /**
     * AssetVideoService constructor.
     *
     * @param AssetVideoRepositoryInterface $videoRepository
     */
    public function __construct(
        AssetRepositoryInterface $assetRepository,
        AssetVideoRepositoryInterface $videoRepository
    ) {
        $this->assetRepository = $assetRepository;
        $this->videoRepository = $videoRepository;
    }

    /**
     * Get all videos.
     *
     * This function return all videos.
     *
     * @return \LaraFilm\Domain\Models\Asset\Video[]
     */
    public function getAll(): array
    {
        return $this->videoRepository->getAll();
    }

    /**
     * Find the video.
     *
     * @param string $id
     * @return \LaraFilm\Domain\Models\Asset\Video
     */
    public function findById(string $id): Video
    {
        return $this->videoRepository->findById(new Id($id));
    }

    /**
     * Create the video.
     *
     * @param array $data
     * @return \LaraFilm\Domain\Models\Asset\Video
     * @throws \Exception
     */
    public function create(array $data): Video
    {
        $video = new Video(
            new Id(null),
            $this->assetRepository->findById(new Id($data['assetId'])),
            $data['duration'],
            $data['width'],
            $data['height'],
            new ValueObject($data['aspectRatio']),
            $data['fps']
        );

        return $this->videoRepository->save($video);
    }

    /**
     * Delete the video.
     *
     * @param \LaraFilm\Domain\Models\Asset\Video $video
     * @return bool
     * @throws \Exception
     */
    public function delete(Video $video): bool
    {
        return $this->videoRepository->delete($video);
    }
}
