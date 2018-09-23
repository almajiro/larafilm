<?php

namespace LaraFilm\Domain\Models\Asset;

use Carbon\Carbon;
use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Shared\AbstractEntity;
use LaraFilm\Domain\Models\Asset\Type\Type;

/**
 * Class Asset
 *
 * @package LaraFilm\Domain\Models\Asset
 */
class Asset extends AbstractEntity
{
    /**
     * @var Id
     */
    private $id;

    /**
     * @var Type
     */
    private $fileType;

    /**
     * @var ValueObject
     */
    private $extension;

    /**
     * @var Carbon
     */
    private $createdAt;

    /**
     * @var Carbon
     */
    private $updatedAt;

    /**
     * Asset constructor.
     *
     * @param Id $id
     * @param Type $fileType
     * @param ValueObject $extension
     * @param Carbon|null $createdAt
     * @param Carbon|null $updatedAt
     */
    public function __construct(
        Id $id,
        Type $fileType,
        ValueObject $extension,
        Carbon $createdAt = null,
        Carbon $updatedAt = null
    ) {
        $this->setId($id);
        $this->setFileType($fileType);
        $this->setExtension($extension);
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
     * @return Type
     */
    public function fileType(): Type
    {
        return $this->fileType;
    }

    /**
     * @return ValueObject
     */
    public function extension(): ValueObject
    {
        return $this->extension;
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
     * @param Type $type
     *
     * @return $this
     */
    public function setFileType(Type $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param ValueObject $extension
     *
     * @return $this
     */
    public function setExtension(ValueObject $extension)
    {
        $this->extension = $extension;

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
}
