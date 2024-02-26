<?php

namespace App\Services;

use App\Exceptions\ProviderHttpRequestException;
use App\Values\UrlShortened;
use Illuminate\Support\Facades\Http;

class TinyUrlShortenerService implements UrlShortenerServiceContract
{
    /**
     * @param string $host
     */
    public function __construct(
        private readonly string $host
    )
    {}

    /**
     * @param string $source
     * @return UrlShortened
     * @throws ProviderHttpRequestException
     */
    public function getUrl(string $source): UrlShortened
    {
        $response = Http::get(
            $this->getFullEndPoint(),
            [
                'url' => $source
            ]
        );
        $statusCode = $response->status();
        if ($statusCode !== 200) {
            throw new ProviderHttpRequestException($statusCode);
        }
        return new UrlShortened(
            $response->body()
        );
    }

    /**
     * @return string
     */
    private function getFullEndPoint(): string
    {
        return "{$this->host}/api-create.php";
    }
}
