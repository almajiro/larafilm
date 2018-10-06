<?php

namespace LaraFilm\Infrastructure\Persistence;

use Carbon\Carbon;
use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Models\Asset\Image as ImageEntity;
use LaraFilm\Infrastructure\Persistence\Asset;
use LaraFilm\Interfaces\Persistence\Model;

/**
 * Class AssetImage
 *
 * @property string $uuid
 * @property string $asset_uuid
 * @property Asset $asset
 * @property int $type
 * @property string $created_at
 * @property string $updated_at
 * @package LaraFilm\Infrastructure\Persistence
 */
class AssetImage extends Model
{
    /**
     * @var string
     */
    public $table = 'asset_images';

    /**
     * @var array
     */
    public $with = ['asset'];


    /**
     * The asset is related to Asset::class.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function asset()
    {
        return $this->belongsTo(
            Asset::class,
            'asset_uuid',
            'uuid'
        );
    }

    /**
     * Convert Persistence to Image Entity
     *
     * @return ImageEntity
     * @throws \LaraFilm\Domain\Exceptions\InvalidArgumentException
     */
    public function toEntity(): ImageEntity
    {
        return new ImageEntity(
            new Id($this->uuid),
            $this->asset->toEntity(),
            $this->type,
            new Carbon($this->created_at),
            new Carbon($this->updated_at)
        );
    }
}
