<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShortUrlRequest;
use App\Services\UrlShortenerServiceContract;
use Symfony\Component\HttpFoundation\JsonResponse;

class ShortUrlController extends Controller
{
    /**
     * @param UrlShortenerServiceContract $urlShortenerService
     */
    public function __construct(
        private readonly UrlShortenerServiceContract $urlShortenerService
    )
    {}

    /**
     * @param CreateShortUrlRequest $request
     * @return JsonResponse
     */
    public function create(CreateShortUrlRequest $request): JsonResponse
    {
        return response()->json(
            [
                'url' => $this->urlShortenerService
                    ->getUrl($request->url)
                    ->get()
            ]
        );
    }
}
