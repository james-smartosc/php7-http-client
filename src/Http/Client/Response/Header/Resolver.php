<?php

declare(strict_types=1);

namespace Http\Client\Response\Header;

use Http\Client\MessageInterface;
use Http\Client\ResponseInterface;

/**
 * Class Resolver.
 *
 * Responsible for unsetting unused headers from parsed HTTP header.
 */
class Resolver
{
    /**
     * Unsets status_code and protocol_version headers from parsed HTTP header.
     *
     * @param array $headers
     */
    public static function resolveHeaders(array &$headers): void
    {
        unset($headers[ResponseInterface::HTTP_STATUS_CODE_KEY]);
        unset($headers[MessageInterface::HTTP_PROTOCOL_VERSION_KEY]);
    }
}
