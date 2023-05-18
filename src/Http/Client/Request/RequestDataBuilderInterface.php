<?php

declare(strict_types=1);

namespace Http\Client\Request;

/**
 * Interface RequestDataBuilderInterface.
 *
 * Interface for building request parts such as URL and Payload.
 */
interface RequestDataBuilderInterface
{
    public const URL_QUERY_KEY = 'query';
    public const URL_QUERY_SEPARATOR = '?';

    /**
     * Builds URL endpoint and JSON encoded payload data based on HTTP method.
     *
     * @param string $method
     * @param string $url
     * @param array $payload
     * @return string
     */
    public static function execute(string $method, string $url, array $payload = []): string;
}
