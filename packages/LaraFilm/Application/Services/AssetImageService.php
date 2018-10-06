<?php

namespace LaraFilm\Application\Services;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Models\Asset\Image;
use LaraFilm\Domain\Models\Asset\AssetRepositoryInterface;
use LaraFilm\Domain\Models\Asset\AssetImageRepositoryInterface;
use LaraFilm\Interfaces\Services\AssetImageServiceInterface;

/**
 * Class AssetImageService
 *
 * @package LaraFilm\Application\Services
 */
class AssetImageService implements AssetImageServiceInterface
{
    private $assetRepository;

    /**
     * @var AssetImageRepositoryInterface
     */
    private $imageRepository;

    /**
     * AssetImageService constructor.
     *
     * @param AssetImageRepositoryInterface $imageRepository
     */
    public function __construct(
        AssetRepositoryInterface $assetRepository,
        AssetImageRepositoryInterface $imageRepository
    ) {
        $this->assetRepository = $assetRepository;
        $this->imageRepository = $imageRepository;
    }

    /**
     * Get all images.
     *
     * This function return all images.
     *
     * @return \LaraFilm\Domain\Models\Asset\Image[]
     */
    public function getAll(): array
    {
        return $this->imageRepository->getAll();
    }

    /**
     * Find the image.
     *
     * @param string $id
     * @return \LaraFilm\Domain\Models\Asset\Image
     */
    public function findById(string $id): Image
    {
        return $this->imageRepository->findById(new Id($id));
    }

    /**
     * Create the image.
     *
     * @param string $name
     * @return \LaraFilm\Domain\Models\Asset\Image
     * @throws \Exception
     */
    public function create(string $assetId, int $type): Image
    {
        $image = new Image(
            new Id(null),
            $this->assetRepository->findById(new Id($assetId)),
            $type
        );

        return $this->imageRepository->save($image);
    }

    /**
     * Delete the image.
     *
     * @param \LaraFilm\Domain\Models\Asset\Image $image
     * @return bool
     * @throws \Exception
     */
    public function delete(Image $image): bool
    {
        return $this->imageRepository->delete($image);
    }
}
