<?php

namespace LaraFilm\Domain\Models\Tv;

use LaraFilm\Domain\Shared\ValueObject;

/**
 * Class Status
 *
 * @package LaraFilm\Domain\Models\Tv
 */
class Status
{
    /**
     * @var int
     */
    private $status;

    /**
     * @var array
     */
    private $state = [
        'Ended',
        'New Series',
        'Returning Series'
    ];

    /**
     * Status constructor.
     *
     * @param int $status
     */
    public function __construct(int $status)
    {
        $this->setStatus($status);
    }

    /**
     * @param bool $status
     *
     * @return $this
     */
    public function setStatus(bool $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return bool
     */
    public function status(): bool
    {
        return $this->status;
    }

    /**
     * @return ValueObject
     */
    public function state(): ValueObject
    {
        return new ValueObject($this->state[$this->status()]);
    }
}
