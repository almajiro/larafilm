<?php

namespace LaraFilm\Domain\Models\Tv;

use Carbon\Carbon;
use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Shared\AbstractEntity;
use LaraFilm\Domain\Models\Tv\Status;
use LaraFilm\Domain\Models\Genre\Genre;
use LaraFilm\Domain\Models\Company\Company;
use LaraFilm\Domain\Models\Actor\Actor;
use LaraFilm\Domain\Models\Asset\Image;
use LaraFilm\Domain\Models\Season\Season;

/**
 * Class Tv
 *
 * @package LaraFilm\Domain\Models\Tv
 */
class Tv extends AbstractEntity
{
    /**
     * @var Id
     */
    private $id;

    /**
     * @var ValueObject
     */
    private $name;

    /**
     * @var ValueObject
     */
    private $plot;

    /**
     * @var ValueObject
     */
    private $mpaa;

    /**
     * @var int
     */
    private $year;

    /**
     * @var float
     */
    private $rating;

    /**
     * @var int
     */
    private $votes;

    /**
     * @var Status
     */
    private $status;

    /**
     * @var \LaraFilm\Domain\Models\Genre\Genre[]
     */
    private $genres;

    /**
     * @var \LaraFilm\Domain\Models\Company\Company[]
     */
    private $studios;

    /**
     * @var \LaraFilm\Domain\Models\Actor\Actor[]
     */
    private $actors;

    /**
     * @var Image[]
     */
    private $images;

    private $seasons;

    /**
     * @var Carbon|null
     */
    private $createdAt;

    /**
     * @var Carbon|null
     */
    private $updatedAt;

    /**
     * Tv constructor.
     *
     * @param Id $id
     * @param ValueObject $name
     * @param ValueObject $plot
     * @param ValueObject $mpaa
     * @param int $year
     * @param \LaraFilm\Domain\Models\Tv\Status $status
     * @param float $rating
     * @param int $votes
     * @param Genre[] $genres
     * @param Company[] $studios
     * @param Actor[] $actors
     * @param Image[] $images
     * @param Carbon|null $createdAt
     * @param Carbon|null $updatedAt
     */
    public function __construct(
        Id $id,
        ValueObject $name,
        ValueObject $plot,
        ValueObject $mpaa,
        int $year,
        Status $status,
        float $rating = 0,
        int $votes = 0,
        array $genres = [],
        array $studios = [],
        array $actors = [],
        array $images = [],
        array $seasons = [],
        Carbon $createdAt = null,
        Carbon $updatedAt = null
    ) {
        $this->setId($id);
        $this->setName($name);
        $this->setPlot($plot);
        $this->setMpaa($mpaa);
        $this->setYear($year);
        $this->setRating($rating);
        $this->setVotes($votes);
        $this->setStatus($status);
        $this->setGenres($genres);
        $this->setStudios($studios);
        $this->setActors($actors);
        $this->setImages($images);
        $this->setSeasons($seasons);
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
     * @return ValueObject
     */
    public function name(): ValueObject
    {
        return $this->name;
    }

    /**
     * @return ValueObject
     */
    public function plot(): ValueObject
    {
        return $this->plot;
    }

    /**
     * @return ValueObject
     */
    public function mpaa(): ValueObject
    {
        return $this->mpaa;
    }

    /**
     * @return int
     */
    public function year(): int
    {
        return $this->year;
    }

    /**
     * @return float
     */
    public function rating(): float
    {
        return $this->rating;
    }

    /**
     * @return int
     */
    public function votes(): int
    {
        return $this->votes;
    }

    /**
     * @return Status
     */
    public function status(): Status
    {
        return $this->status;
    }

    /**
     * @return \LaraFilm\Domain\Models\Genre\Genre[]
     */
    public function genres(): array
    {
        return $this->genres;
    }

    /**
     * @return \LaraFilm\Domain\Models\Company\Company[]
     */
    public function studios(): array
    {
        return $this->studios;
    }

    /**
     * @return \LaraFilm\Domain\Models\Actor\Actor[]
     */
    public function actors(): array
    {
        return $this->actors;
    }

    /**
     * @return \LaraFilm\Domain\Models\Asset\Image[]
     */
    public function images(): array
    {
        return $this->images;
    }

    public function seasons(): array
    {
        return $this->seasons;
    }

    /**
     * @return Carbon|mixed
     */
    public function createdAt()
    {
        return $this->createdAt;
    }

    /**
     * @return Carbon|mixed
     */
    public function updatedAt()
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
     * @param ValueObject $name
     *
     * @return $this
     */
    public function setName(ValueObject $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param ValueObject $overview
     *
     * @return $this
     */
    public function setPlot(ValueObject $plot)
    {
        $this->plot = $plot;

        return $this;
    }

    /**
     * @param ValueObject $mpaa
     *
     * @return $this
     */
    public function setMpaa(ValueObject $mpaa)
    {
        $this->mpaa = $mpaa;

        return $this;
    }

    /**
     * @param int $year
     *
     * @return $this
     */
    public function setYear(int $year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @param float $rating
     *
     * @return $this
     */
    public function setRating(float $rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * @param int $votes
     *
     * @return $this
     */
    public function setVotes(int $votes)
    {
        $this->votes = $votes;

        return $this;
    }

    /**
     * @param $status
     *
     * @return $this
     */
    public function setStatus(Status $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param array $genres
     *
     * @return $this
     */
    public function setGenres(array $genres)
    {
        $this->genres = [];

        foreach ($genres as $genre) {
            $this->addGenre($genre);
        }

        return $this;
    }

    /**
     * @param Genre $genre
     *
     * @return $this
     */
    public function addGenre(Genre $genre)
    {
        $this->genres[] = $genre;

        return $this;
    }

    /**
     * @param array $studios
     *
     * @return $this
     */
    public function setStudios(array $studios)
    {
        $this->studios = [];

        foreach ($studios as $studio) {
            $this->addStudio($studio);
        }

        return $this;
    }

    /**
     * @param Company $studio
     *
     * @return $this
     */
    public function addStudio(Company $studio)
    {
        $this->studios[] = $studio;

        return $this;
    }

    /**
     * @param array $actors
     *
     * @return $this
     */
    public function setActors(array $actors)
    {
        $this->actors = [];

        foreach ($actors as $actor) {
            $this->addActor($actor);
        }

        return $this;
    }

    /**
     * @param Actor $actor
     *
     * @return $this
     */
    public function addActor(Actor $actor)
    {
        $this->actors[] = $actor;

        return $this;
    }

    /**
     * @param array $images
     *
     * @return $this
     */
    public function setImages(array $images)
    {
        $this->images = [];

        foreach ($images as $image) {
            $this->addImage($image);
        }

        return $this;
    }

    /**
     * @param Image $image
     *
     * @return $this
     */
    public function addImage(Image $image)
    {
        $this->images[] = $image;

        return $this;
    }

    public function setSeasons(array $seasons)
    {
        $this->seasons = [];

        foreach ($seasons as $season) {
            $this->addSeason($season);
        }

        return $this;
    }

    public function addSeason(Season $seasonId)
    {
        $this->seasons[] = $seasonId;

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
     * Convert to array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $studios = [];
        $genres = [];
        $actors = [];
        $images = [];
        $seasons = [];

        foreach ($this->studios() as $studio) {
            $studios[] = $studio->toArray();
        }

        foreach ($this->genres() as $genre) {
            $genres[] = $genre->toArray();
        }

        foreach ($this->actors() as $actor) {
            $actors[] = $actor->toArray();
        }

        foreach ($this->images() as $image) {
            $images[] = $image->toArray();
        }

        foreach ($this->seasons() as $season) {
            $seasons[] = $season->toArray();
        }

        return array(
            'id' => $this->id()->id(),
            'name' => $this->name()->value(),
            'plot' => $this->plot()->value(),
            'mpaa' => $this->mpaa()->value(),
            'year' => $this->year(),
            'rating' => $this->rating(),
            'votes' => $this->votes(),
            'status' => $this->status()->state()->value(),
            'genres' => $genres,
            'studios' => $studios,
            'actors' => $actors,
            'images' => $images,
            'seasons' => $seasons,
            'created_at' => $this->createdAt->format('Y/m/d H:m:s'),
            'updated_at' => $this->updatedAt->format('Y/m/d H:m:s')
        );
    }
}
