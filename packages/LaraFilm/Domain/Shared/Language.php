<?php

namespace LaraFilm\Domain\Shared;

/**
 * Class Language
 *
 * @package LaraFilm\Domain\Shared
 */
class Language
{
    /**
     * @var
     */
    private $language;

    /**
     * Language constructor.
     *
     * @param $language
     */
    public function __construct($language)
    {
        $this->setLanguage($language);
    }

    /**
     * @param $language
     *
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return mixed
     */
    public function language()
    {
        return $this->language;
    }
}
