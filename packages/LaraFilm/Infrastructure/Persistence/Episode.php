<?php

namespace LaraFilm\Infrastructure\Persistence;

use Carbon\Carbon;
use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Models\Episode\Episode as EpisodeEntity;
use LaraFilm\Interfaces\Persistence\Model;
use LaraFilm\Infrastructure\Persistence\Season;
use LaraFilm\Infrastructure\Persistence\AssetImage;
use LaraFilm\Infrastructure\Persistence\AssetVideo;

/**
 * Class Episode
 *
 * @property string $uuid
 * @property string $season_uuid
 * @property string $title
 * @property string $plot
 * @property int $episode
 * @property string aired
 * @property float $rating
 * @property int $votes
 * @property AssetImage[] $images
 * @property AssetVideo[] $videos
 * @property string $created_at
 * @property string $updated_at
 * @package LaraFilm\Infrastructure\Persistence
 */
class Episode extends Model
{
    /**
     * @var string
     */
    public $table = 'episodes';

    /**
     * The seasons is related to Season::class.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function season()
    {
        return $this->belongsTo(
            Season::class,
            'season_uuid',
            'uuid'
        );
    }

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
     * The videos is related to AssetVideo::class.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function videos()
    {
        return $this->morphMany(
            AssetVideo::class,
            'model',
            'model_type',
            'model_uuid',
            'uuid'
        );
    }

    /**
     * @return EpisodeEntity
     * @throws \LaraFilm\Domain\Exceptions\InvalidArgumentException
     */
    public function toEntity(): EpisodeEntity
    {
        $images = [];
        $videos = [];

        foreach ($this->images as $image) {
            $images[] = $image->toEntity();
        }

        foreach ($this->videos as $video) {
            $videos[] = $video->toEntity();
        }

        return new EpisodeEntity(
            new Id($this->uuid),
            new Id($this->season_uuid),
            new ValueObject($this->title),
            new ValueObject($this->plot),
            $this->episode,
            new Carbon($this->aired),
            $this->rating,
            $this->votes,
            $images,
            $videos,
            new Carbon($this->created_at),
            new Carbon($this->updated_at)
        );
    }
}
