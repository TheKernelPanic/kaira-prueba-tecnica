<?php

namespace App\Values;

class UrlShortened
{
    /**
     * @param string $url
     */
    public function __construct(
        private readonly string $url
    )
    {}

    /**
     * @return string
     */
    public function get(): string
    {
        return $this->url;
    }
}
