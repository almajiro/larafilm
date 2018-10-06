<?php

namespace LaraFilm\Infrastructure\Persistence;

use Carbon\Carbon;
use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Models\Tv\Status;
use LaraFilm\Domain\Models\Tv\Tv as TvEntity;
use LaraFilm\Infrastructure\Persistence\Season;
use LaraFilm\Infrastructure\Persistence\Genre;
use LaraFilm\Infrastructure\Persistence\Actor;
use LaraFilm\Infrastructure\Persistence\Company;
use LaraFilm\Infrastructure\Persistence\AssetImage;
use LaraFilm\Interfaces\Persistence\Model;

/**
 * Class Tv
 *
 * @property string $uuid
 * @property string $name
 * @property string $plot
 * @property string mpaa
 * @property int $year
 * @property float $rating
 * @property int $votes
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property Company[] $studios
 * @property Genre[] $genres
 * @property Actor[] $actors
 * @property AssetImage[] $images
 * @property Season[] $seasons
 * @package LaraFilm\Infrastructure\Persistence
 */
class Tv extends Model
{
    /**
     * @var string
     */
    public $table = 'tvs';

    /**
     * @var array
     */
    public $with = ['actors', 'studios', 'genres', 'images', 'seasons'];

    /**
     * The actors is related to Actor::class.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function actors()
    {
        return $this->morphToMany(
            Actor::class,
            'model',
            'model_has_actors',
            'model_uuid',
            'actor_uuid',
            'uuid',
            'uuid',
            false
        );
    }

    /**
     * The studios is related to Company::class.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function studios()
    {
        return $this->morphToMany(
            Company::class,
            'model',
            'model_has_studios',
            'model_uuid',
            'company_uuid',
            'uuid',
            'uuid',
            false
        );
    }

    /**
     * The genres is related to Genre::class.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function genres()
    {
        return $this->morphToMany(
            Genre::class,
            'model',
            'model_has_genres',
            'model_uuid',
            'genre_uuid',
            'uuid',
            'uuid',
            false
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
     * The seasons is related to Seasons::class.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seasons()
    {
        return $this->hasMany(
            Season::class,
            'tv_uuid',
            'uuid'
        );
    }

    /**
     * Convert Persistence to Tv Entity.
     *
     * @return TvEntity
     * @throws \LaraFilm\Domain\Exceptions\InvalidArgumentException
     */
    public function toEntity()
    {
        $studios = [];
        $genres = [];
        $actors = [];
        $images = [];
        $seasons = [];

        foreach ($this->studios as $studio) {
            $studios[] = $studio->toEntity();
        }

        foreach ($this->genres as $genre) {
            $genres[] = $genre->toEntity();
        }

        foreach ($this->actors as $actor) {
            $actors[] = $actor->toEntity();
        }

        foreach ($this->images as $image) {
            $images[] = $image->toEntity();
        }

        foreach ($this->seasons as $season) {
            $seasons[] = $season->toEntity();
        }

        return new TvEntity(
            new Id($this->uuid),
            new ValueObject($this->name),
            new ValueObject($this->plot),
            new ValueObject($this->mpaa),
            $this->year,
            new Status($this->status),
            $this->rating,
            $this->votes,
            $genres,
            $studios,
            $actors,
            $images,
            $seasons,
            $this->created_at ?? new Carbon($this->created_at) ?? null,
            $this->updated_at ?? new Carbon($this->updated_at) ?? null

        );
    }
}
