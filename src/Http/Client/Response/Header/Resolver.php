<?php

declare(strict_types=1);

namespace Http\Client\Response\Header;

use Http\Client\MessageInterface;
use Http\Client\ResponseInterface;

class Resolver
{
    public static function resolveHeaders(array &$headers): void
    {
        unset($headers[ResponseInterface::HTTP_STATUS_CODE_KEY]);
        unset($headers[MessageInterface::HTTP_PROTOCOL_VERSION_KEY]);
    }
}
