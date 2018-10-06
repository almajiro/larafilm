<?php

namespace LaraFilm\Infrastructure\Persistence;

use Carbon\Carbon;
use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Models\Person\Person as PersonEntity;
use LaraFilm\Infrastructure\Persistence\AssetImage;
use LaraFilm\Interfaces\Persistence\Model;

/**
 * Class Person
 *
 * @property string $uuid
 * @property string $name
 * @property AssetImage $images
 * @property string created_at
 * @property string updated_at
 * @package LaraFilm\Infrastructure\Persistence
 */
class Person extends Model
{
    /**
     * @var string
     */
    public $table = 'persons';

    /**
     * @var array
     */
    public $with = ['images'];

    /**
     * The images is related to AssetImage::class.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function images()
    {
        return $this->morphToMany(
            AssetImage::class,
            'model',
            'model_has_images',
            'model_uuid',
            'image_uuid',
            'uuid',
            'uuid',
            false
        );
    }

    /**
     * Convert Persistence to Person Entity.
     *
     * @return Person
     *
     * @throws \Exception
     */
    public function toEntity(): PersonEntity
    {
        $images = [];

        foreach ($this->images as $image) {
            $images[] = $image->toEntity();
        }

        return new PersonEntity(
            new Id($this->uuid),
            new ValueObject($this->name),
            $images,
            $this->created_at ?? new Carbon($this->created_at) ?? null,
            $this->updated_at ?? new Carbon($this->updated_at) ?? null
        );
    }

}
