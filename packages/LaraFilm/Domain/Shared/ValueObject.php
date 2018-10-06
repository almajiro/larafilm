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
    public function __construct(string $value = null)
    {
        $this->setValue($value);
    }

    /**
     * @param $value
     */
    public function setValue(string $value = null)
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
