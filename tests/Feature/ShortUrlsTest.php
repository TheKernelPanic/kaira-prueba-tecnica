<?php

namespace Tests\Feature;

use Tests\TestCase;

class ShortUrlsTest extends TestCase
{
    /**
     * @return void
     */
    public function test_respond_successfully(): void
    {
        $response = $this
            ->withHeaders([
                'Authorization' => 'Bearer {}[]{}[]()',
                'Accept' => 'application/json'
            ])
            ->post(
            route('short.urls.create'),
            [
                'url' => fake()->url
            ]
        );
        $response->assertOk();
    }

    /**
     * @desc Invalid pattern token
     * @return void
     */
    public function test_respond_unauthorized(): void
    {
        $response = $this
            ->withHeaders([
                'Authorization' => 'Bearer {}[]{}[]()]]',
                'Accept' => 'application/json'
            ])
            ->post(
                route('short.urls.create'),
                [
                    'url' => fake()->url
                ]
            );
        $response->assertUnauthorized();
    }

    /**
     * @desc Missing token
     * @return void
     */
    public function test_respond_invalid_request_token(): void
    {
        $response = $this
            ->withHeaders([
                'Accept' => 'application/json'
            ])
            ->post(
                route('short.urls.create'),
                [
                    'url' => fake()->url
                ]
            );
        $response->assertBadRequest();
    }

    /**
     * @desc Invalid url
     * @return void
     */
    public function test_respond_invalid_request_url(): void
    {
        $response = $this
            ->withHeaders([
                'Authorization' => 'Bearer {}[]{}[]',
                'Accept' => 'application/json'
            ])
            ->post(
                route('short.urls.create'),
                [
                    'url' => 'Wrong text'
                ]
            );
        $response->assertStatus(422);
    }
}
