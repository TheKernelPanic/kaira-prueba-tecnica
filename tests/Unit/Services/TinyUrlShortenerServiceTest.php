<?php

namespace Tests\Unit\Services;

use App\Exceptions\ProviderHttpRequestException;
use App\Services\TinyUrlShortenerService;
use App\Services\UrlShortenerServiceContract;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class TinyUrlShortenerServiceTest extends TestCase
{
    /**
     * @var UrlShortenerServiceContract
     */
    private UrlShortenerServiceContract $service;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->service = new TinyUrlShortenerService(fake()->url);
    }

    /**
     * @return void
     * @throws ProviderHttpRequestException
     */
    public function test_get_url_successfully(): void
    {
        Http::fake([
            '*' => Http::response($expectedShortened = fake()->url)
        ]);

        $this->assertEquals(
            $expectedShortened,
            $this->service->getUrl(fake()->url)->get()
        );
    }

    /**
     * @return void
     * @throws ProviderHttpRequestException
     */
    public function test_get_url_failed(): void
    {
        Http::fake([
            '*' => Http::response(status: 400)
        ]);
        $this->expectException(ProviderHttpRequestException::class);
        $this->service->getUrl(fake()->url);
    }
}
