<?php

namespace LaraFilm\Infrastructure\Persistence;

use Carbon\Carbon;
use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Models\Asset\Video as VideoEntity;
use LaraFilm\Infrastructure\Persistence\Asset;
use LaraFilm\Interfaces\Persistence\Model;

/**
 * Class AssetVideo
 *
 * @property string $uuid
 * @property string $asset_uuid
 * @property int $duration
 * @property int $height
 * @property int $width
 * @property string $aspect_ratio
 * @property int $fps
 * @property string $chapter
 * @package LaraFilm\Infrastructure\Persistence
 */
class AssetVideo extends Model
{
    /**
     * @var string
     */
    public $table = 'asset_videos';

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
     * Convert Persistence to Entity.
     *
     * @return VideoEntity
     */
    public function toEntity(): VideoEntity
    {
        return new VideoEntity(
            new Id($this->uuid),
            $this->asset->toEntity(),
            $this->duration,
            $this->width,
            $this->height,
            new ValueObject($this->aspect_ratio),
            $this->fps,
            new Carbon($this->created_at),
            new Carbon($this->updated_at)
        );
    }
}
