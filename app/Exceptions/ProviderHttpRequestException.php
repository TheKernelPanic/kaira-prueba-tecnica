<?php

namespace App\Exceptions;


class ProviderHttpRequestException extends \Exception
{
    /**
     * @param int $httpStatusCode
     */
    public function __construct(int $httpStatusCode)
    {
        parent::__construct("Http service failed with status {$httpStatusCode}");
    }
}
