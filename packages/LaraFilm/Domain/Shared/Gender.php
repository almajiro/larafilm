<?php

namespace LaraFilm\Domain\Shared;

/**
 * Class Gender
 *
 * @package LaraFilm\Domain\Shared
 */
class Gender
{
    /**
     * @var
     */
    private $gender;

    /**
     * Gender constructor.
     *
     * @param bool $gender
     */
    public function __construct(bool $gender)
    {
        $this->setGender($gender);
    }

    /**
     * Set gender.
     *
     * @param bool $gender
     *
     * @return $this
     */
    public function setGender(bool $gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Return gender.
     *
     * @return bool
     */
    public function gender(): bool
    {
        return $this->gender;
    }
}
