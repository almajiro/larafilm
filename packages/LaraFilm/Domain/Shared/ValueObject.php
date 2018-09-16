<?php

namespace LaraFilm\Domain\Shared;

/**
 * Class ValueObject
 * @package LaraFilm\Domain\Shared
 */
class ValueObject
{
    /**
     * @var
     */
    private $objectValue;

    /**
     * ValueObject constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->setValue($value);
    }

    /**
     * @param $value
     */
    public function setValue($value)
    {
        $this->objectValue = $value;
    }

    /**
     * @return mixed
     */
    public function value()
    {
        return $this->objectValue;
    }
}
