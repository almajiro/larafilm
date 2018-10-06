<?php

namespace LaraFilm\Domain\Models\Asset;

use LaraFilm\Domain\Shared\AbstractEntity;
use LaraFilm\Domain\Exceptions\InvalidArgumentException;

/**
 * Class Type
 *
 * @package LaraFilm\Domain\Models\Asset
 */
class Type extends AbstractEntity
{
    /**
     * @var array
     */
    private $types = [
        '0' => 'audios',
        '1' => 'videos',
        '2' => 'images',
        '3' => 'pictures'
    ];

    /**
     * @var
     */
    private $type;

    /**
     * Type constructor.
     *
     * @param int $type
     * @throws InvalidArgumentException
     */
    public function __construct(int $type)
    {
        $this->setType($type);
    }

    /**
     * @param int $type
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setType(int $type)
    {
        if (!in_array($type, array_flip($this->types), true)) {
            throw new InvalidArgumentException('Invalid Argument');
        }

        $this->type = $type;

        return $this;
    }

    /**
     * @return int
     */
    public function type(): int
    {
        return $this->type;
    }

    public function folder(): string
    {
        return $this->types[$this->type()];
    }
}
