<?php

namespace App\Services;

use App\Values\UrlShortened;

interface UrlShortenerServiceContract
{
    /**
     * @param string $source
     * @return UrlShortened
     */
    public function getUrl(string $source): UrlShortened;
}
