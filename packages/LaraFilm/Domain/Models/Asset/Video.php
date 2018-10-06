<?php

namespace LaraFilm\Domain\Models\Asset;

use Carbon\Carbon;
use LaraFilm\Domain\Models\Asset\Asset;
use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Shared\AbstractEntity;

/**
 * Class Video
 *
 * @package LaraFilm\Domain\Models\Asset
 */
class Video
{
    /**
     * @var Id
     */
    private $id;

    /**
     * @var Asset
     */
    private $asset;

    /**
     * @var int
     */
    private $duration;

    /**
     * @var int
     */
    private $height;

    /**
     * @var int
     */
    private $width;

    /**
     * @var ValueObject
     */
    private $aspectRatio;

    /**
     * @var int
     */
    private $fps;

    /**
     * @var Carbon
     */
    private $createdAt;

    /**
     * @var Carbon
     */
    private $updatedAt;

    /**
     * Video constructor.
     *
     * @param Id $id
     * @param \LaraFilm\Domain\Models\Asset\Asset $asset
     * @param int $duration
     * @param int $width
     * @param int $height
     * @param ValueObject $aspectRatio
     * @param int fps
     * @param Carbon|null $createdAt
     * @param Carbon|null $updatedAt
     */
    public function __construct(
        Id $id,
        Asset $asset,
        int $duration,
        int $width,
        int $height,
        ValueObject $aspectRatio,
        int $fps,
        Carbon $createdAt = null,
        Carbon $updatedAt = null
    ) {
        $this->setId($id);
        $this->setAsset($asset);
        $this->setDuration($duration);
        $this->setWidth($width);
        $this->setHeight($height);
        $this->setAspectRatio($aspectRatio);
        $this->setFps($fps);
        $this->setCreatedAt($createdAt);
        $this->setUpdatedAt($updatedAt);
    }

    /**
     * @return Id
     */
    public function id(): Id
    {
        return $this->id;
    }

    /**
     * @return \LaraFilm\Domain\Models\Asset\Asset
     */
    public function asset(): Asset
    {
        return $this->asset;
    }

    /**
     * @return int
     */
    public function duration(): int
    {
        return $this->duration;
    }

    /**
     * @return int
     */
    public function width(): int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function height(): int
    {
        return $this->height;
    }

    /**
     * @return ValueObject
     */
    public function aspectRatio(): ValueObject
    {
        return $this->aspectRatio;
    }

    /**
     * @return int
     */
    public function fps(): int
    {
        return $this->fps;
    }

    /**
     * @return Carbon
     */
    public function createdAt(): Carbon
    {
        return $this->createdAt;
    }

    /**
     * @return Carbon
     */
    public function updatedAt(): Carbon
    {
        return $this->updatedAt;
    }

    /**
     * @param Id $id
     *
     * @return $this
     */
    public function setId(Id $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param \LaraFilm\Domain\Models\Asset\Asset $asset
     *
     * @return $this
     */
    public function setAsset(Asset $asset)
    {
        $this->asset = $asset;

        return $this;
    }


    /**
     * @param int $duration
     *
     * @return $this
     */
    public function setDuration(int $duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @param int $width
     *
     * @return $this
     */
    public function setWidth(int $width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @param int $height
     *
     * @return $this
     */
    public function setHeight(int $height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @param ValueObject $aspectRatio
     *
     * @return $this
     */
    public function setAspectRatio(ValueObject $aspectRatio)
    {
        $this->aspectRatio = $aspectRatio;

        return $this;
    }

    /**
     * @param int $fps
     *
     * @return $this
     */
    public function setFps(int $fps)
    {
        $this->fps = $fps;

        return $this;
    }

    /**
     * @param Carbon|null $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(Carbon $createdAt = null)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @param Carbon|null $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt(Carbon $updatedAt = null)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array(
            'id' => $this->id()->id(),
            'duration' => $this->duration(),
            'width' => $this->width(),
            'height' => $this->height(),
            'aspect_ratio' => $this->aspectRatio()->value(),
            'fps' => $this->fps(),
            'asset' => $this->asset()->toArray()
        );
    }
}
