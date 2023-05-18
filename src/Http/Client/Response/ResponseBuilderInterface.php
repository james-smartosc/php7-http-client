<?php

declare(strict_types=1);

namespace Http\Client\Response;

use Http\Client\ResponseInterface;

/**
 * Interface ResponseBuilderInterface.
 */
interface ResponseBuilderInterface
{
    /**
     * Builds Response instance based on response result from request.
     *
     * @param string $body
     * @param array $httpHeaders
     * @return ResponseInterface
     */
    public static function execute(
        string $body,
        array  $httpHeaders = []
    ): ResponseInterface;
}
