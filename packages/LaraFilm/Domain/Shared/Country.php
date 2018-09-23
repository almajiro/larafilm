<?php

namespace LaraFilm\Domain\Shared;

/**
 * Class Country
 *
 * @package LaraFilm\Domain\Shared
 */
class Country
{
    /**
     * @var
     */
    private $country;

    /**
     * Country constructor.
     *
     * @param int $country
     */
    public function __construct(int $country)
    {
        $this->setCountry($country);
    }

    /**
     * @param $country
     *
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return mixed
     */
    public function country()
    {
        return $this->country;
    }
}
