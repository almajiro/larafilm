<?php

namespace LaraFilm\Infrastructure\Repositories;

use LaraFilm\Domain\Shared\Id;
use LaraFilm\Domain\Models\Episode\Episode as EpisodeEntity;
use LaraFilm\Domain\Models\Season\Season as SeasonEntity;
use LaraFilm\Domain\Models\Episode\EpisodeRepositoryInterface;
use LaraFilm\Infrastructure\Persistence\Episode;
use LaraFilm\Infrastructure\Persistence\AssetVideo;

/**
 * Class EpisodeRepository
 *
 * @package LaraFilm\Infrastructure\Repositories
 */
class EpisodeRepository implements EpisodeRepositoryInterface
{
    /**
     * @var Episode
     */
    private $episodePersistence;

    private $videoPersistence;

    /**
     * EpisodeRepository constructor.
     *
     * @param Episode $episodePersistence
     */
    public function __construct(
        Episode $episodePersistence,
        AssetVideo $videoPersistence
    ) {
        $this->episodePersistence = $episodePersistence;
        $this->videoPersistence = $videoPersistence;
    }

    /**
     * Return all episodes.
     *
     * @return array
     */
    public function getAll(): array
    {
        $episodePersistences = $this->episodePersistence->all();
        $episodes = [];

        foreach ($episodePersistences as $episode) {
            $episodes[] = $episode->toEntity();
        }

        return $episodes;
    }

    public function findBySeason(SeasonEntity $season): array
    {
        $episodePersistences = $this->episodePersistence
            ->where('season_uuid', '=', $season->id()->id())
            ->orderBy('episode', 'asc')
            ->get();

        $episodes = [];

        foreach ($episodePersistences as $episode) {
            $episodes[] = $episode->toEntity();
        }

        return $episodes;
    }

    /**
     * Find the episode.
     *
     * @param Id $id
     *
     * @return EpisodeEntity
     */
    public function findById(Id $id): EpisodeEntity
    {
        $episodePersistence = $this->episodePersistence->find($id->id());
        $episode = $episodePersistence->toEntity();

        return $episode;
    }

    /**
     * Save the episode.
     *
     * @param EpisodeEntity $episode
     *
     * @return EpisodeEntity
     * @throws \Exception
     */
    public function save(EpisodeEntity $episode): EpisodeEntity
    {
        $episodePersistence = $this->toPersistence($episode);
        $episodePersistence->save();

        $episode = $episodePersistence->toEntity();

        return $episode;
    }

    /**
     * Delete the episode.
     *
     * @param EpisodeEntity $episode
     *
     * @return bool
     * @throws \Exception
     */
    public function delete(EpisodeEntity $episode): bool
    {
        $episodePersistence = $this->toPersistence($episode);
        $episodePersistence->delete();

        return true;
    }

    /**
     * Convert Entity to Persistence.
     *
     * @param EpisodeEntity $entity
     *
     * @return Episode
     * @throws \Exception
     */
    public function toPersistence($entity)
    {
        $primaryKey = $entity->id()->id();

        if (is_null($primaryKey)) {
            $episodePersistence = new Episode();
        } else {
            $episodePersistence = $this->episodePersistence->find($primaryKey);
        }

        $images = [];
        $videos = [];

        foreach ($entity->images() as $image) {
            $images[] = $image->id()->id();
        }

        foreach ($entity->videos() as $video) {
            $videos[] = $this->videoPersistence->find($video->id()->id());
        }

        $episodePersistence->images()->sync($images);
        $episodePersistence->videos()->saveMany($videos);

        $episodePersistence->season_uuid = $entity->seasonId()->id();
        $episodePersistence->title = $entity->title()->value();
        $episodePersistence->plot = $entity->plot()->value();
        $episodePersistence->episode = $entity->episode();
        $episodePersistence->aired = $entity->aired()->format('Y-m-d');
        $episodePersistence->rating = $entity->rating();
        $episodePersistence->votes = $entity->votes();

        return $episodePersistence;
    }
}
