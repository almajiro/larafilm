<?php

namespace LaraFilm\Domain\Models\Episode;

use Carbon\Carbon;
use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Shared\ValueObject;
use LaraFilm\Domain\Shared\AbstractEntity;
use LaraFilm\Domain\Models\Asset\Image;
use LaraFilm\Domain\Models\Asset\Video;

/**
 * Class Episode
 *
 * @package LaraFilm\Domain\Models\Episode
 */
class Episode extends AbstractEntity
{
    /**
     * @var Id
     */
    private $id;

    /**
     * @var Id
     */
    private $seasonId;

    /**
     * @var ValueObject
     */
    private $title;

    /**
     * @var ValueObject
     */
    private $plot;

    /**
     * @var int
     */
    private $episode;

    /**
     * @var Carbon
     */
    private $aired;

    /**
     * @var float
     */
    private $rating;

    /**
     * @var int
     */
    private $votes;

    /**
     * @var Image[]
     */
    private $images;

    /**
     * @var
     */
    private $videos;

    /**
     * @var Carbon
     */
    private $createdAt;

    /**
     * @var Carbon
     */
    private $updatedAt;

    /**
     * Episode constructor.
     * @param Id $id
     * @param Id $seasonId
     * @param ValueObject $title
     * @param ValueObject $plot
     * @param int $episode
     * @param Carbon $aired
     * @param float $rating
     * @param int $votes
     * @param Image[] $images
     * @param Video[] $videos
     * @param Carbon|null $createdAt
     * @param Carbon|null $updatedAt
     */
    public function __construct(
        Id $id,
        Id $seasonId,
        ValueObject $title,
        ValueObject $plot,
        int $episode,
        Carbon $aired,
        float $rating,
        int $votes = 0,
        array $images = [],
        array $videos = [],
        Carbon $createdAt = null,
        Carbon $updatedAt = null
    ) {
        $this->setId($id);
        $this->setTvId($seasonId);
        $this->settitle($title);
        $this->setPlot($plot);
        $this->setEpisode($episode);
        $this->setAired($aired);
        $this->setRating($rating);
        $this->setVotes($votes);
        $this->setImages($images);
        $this->setVideos($videos);
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
     * @return Id
     */
    public function seasonId(): Id
    {
        return $this->seasonId;
    }

    /**
     * @return ValueObject
     */
    public function title(): ValueObject
    {
        return $this->title;
    }

    /**
     * @return ValueObject
     */
    public function plot(): ValueObject
    {
        return $this->plot;
    }

    /**
     * @return int
     */
    public function episode(): int
    {
        return $this->episode;
    }

    /**
     * @return Carbon
     */
    public function aired(): Carbon
    {
        return $this->aired;
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
     * @return Image[]
     */
    public function images(): array
    {
        return $this->images;
    }

    /**
     * @return Video[]
     */
    public function videos(): array
    {
        return $this->videos;
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
     * @param Id $seasonId
     *
     * @return $this
     */
    public function setTvId(Id $seasonId)
    {
        $this->seasonId = $seasonId;

        return $this;
    }

    /**
     * @param ValueObject $title
     *
     * @return $this
     */
    public function setTitle(ValueObject $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param ValueObject $plot
     *
     * @return $this
     */
    public function setPlot(ValueObject $plot)
    {
        $this->plot = $plot;

        return $this;
    }

    /**
     * @param int $episode
     *
     * @return $this
     */
    public function setEpisode(int $episode)
    {
        $this->episode = $episode;

        return $this;
    }

    /**
     * @param Carbon $aired
     * @return $this
     */
    public function setAired(Carbon $aired)
    {
        $this->aired = $aired;

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
     * @param Image[] $images
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

    /**
     * @param Video[] $videos
     *
     * @return $this
     */
    public function setVideos(array $videos)
    {
        $this->videos = [];

        foreach ($videos as $video) {
            $this->addVideo($video);
        }

        return $this;
    }

    /**
     * @param Video $video
     *
     * @return $this
     */
    public function addVideo(Video $video)
    {
        $this->videos[] = $video;

        return $this;
    }

    /**
     * @param Carbon $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(Carbon $createdAt = null)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @param Carbon $updatedAt
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
    public function toArray(): array {
        $images = [];
        $videos = [];

        foreach ($this->images() as $image) {
            $images[] = $image->toArray();
        }

        foreach ($this->videos() as $video) {
            $videos[] = $video->toArray();
        }

        return array(
            'id' => $this->id()->id(),
            'season_id' => $this->seasonId()->id(),
            'title' => $this->title()->value(),
            'plot' => $this->plot()->value(),
            'episode' => $this->episode(),
            'aired' => $this->aired()->format('Y/m/d'),
            'rating' => $this->rating(),
            'votes' => $this->votes(),
            'images' => $images,
            'videos' => $videos,
            'created_at' => $this->createdAt()->format('Y/m/d H:m:s'),
            'updated_at' => $this->updatedAt()->format('Y/m/d H:m:s')
        );
    }
}
