<?php

declare(strict_types=1);

namespace Http\Client\Request;

use Http\Client\RequestInterface;
use InvalidArgumentException;
use JsonException;

/**
 * Interface RequestBuilderInterface.
 */
interface RequestBuilderInterface
{
    public const STREAM_CONTEXT_HTTP_KEY = 'http';
    public const STREAM_CONTEXT_HTTP_METHOD_KEY = 'method';
    public const STREAM_CONTEXT_HTTP_HEADER_KEY = 'header';
    public const STREAM_CONTEXT_HTTP_CONTENT_KEY = 'content';
    public const STREAM_CONTEXT_HEADER_DELIMITER = "\r\n";

    /**
     * @param string $method
     * @param string $url
     * @param array $payload
     * @param array $headers
     *
     * @return RequestInterface
     *
     * @throws JsonException When JSON encode payload fails.
     * @throws InvalidArgumentException When URL is in wrong format and unable to be parsed.
     */
    public static function execute(
        string $method,
        string $url,
        array  $payload = [],
        array  $headers = []
    ): RequestInterface;
}
