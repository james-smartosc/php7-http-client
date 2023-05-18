<?php

declare(strict_types=1);

namespace Http\Client\Response;

use Http\Client\ResponseInterface;
use InvalidArgumentException;

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
     *
     * @return ResponseInterface
     *
     * @throws InvalidArgumentException If status code not in range or headers not contains required HTTP response data.
     */
    public static function execute(string $body, array $httpHeaders = []): ResponseInterface;
}
