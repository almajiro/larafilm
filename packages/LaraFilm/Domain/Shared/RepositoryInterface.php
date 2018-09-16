<?php

namespace LaraFilm\Domain\Shared;

/**
 * Interface RepositoryInterface
 *
 * @package LaraFilm\Domain\Shared
 */
interface RepositoryInterface
{
    /**
     * Convert Persistence to Entity
     *
     * @param $persistence
     *
     * @return mixed
     */
    public function toEntity($persistence);

    /**
     * Convert Entity to Persistence
     *
     * @param $entity
     *
     * @return mixed
     */
    public function toPersistence($entity);
}
