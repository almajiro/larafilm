<?php

namespace LaraFilm\Infrastructure\Persistence;

use Carbon\Carbon;
use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Models\Asset\Type;
use LaraFilm\Domain\Models\Asset\Asset as AssetEntity;
use LaraFilm\Interfaces\Persistence\Model;

/**
 * Class Asset
 *
 * @property string $uuid
 * @property int $file_type
 * @property string $extension
 * @property string $created_at
 * @property string $updated_at
 * @package LaraFilm\Infrastructure\Persistence
 */
class Asset extends Model
{
    /**
     * @var string
     */
    public $table = 'assets';

    /**
     * Convert Persistence to Asset Entity.
     *
     * @return AssetEntity
     * @throws \LaraFilm\Domain\Exceptions\InvalidArgumentException
     */
    public function toEntity(): AssetEntity
    {
        return new AssetEntity(
            new Id($this->uuid),
            new Type($this->file_type),
            new ValueObject($this->extension),
            new Carbon($this->created_at),
            new Carbon($this->updated_at)
        );
    }
}
