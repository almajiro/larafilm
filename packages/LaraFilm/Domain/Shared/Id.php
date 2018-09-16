<?php

namespace LaraFilm\Domain\Shared;

/**
 * Class Id
 *
 * @package LaraFilm\Domain\Shared
 */
class Id
{
    /**
     * @var
     */
    private $id;

    /**
     * Id constructor.
     *
     * @param $id
     */
    public function __construct($id)
    {
        $this->setId($id);
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function id()
    {
        return $this->id;
    }
}
