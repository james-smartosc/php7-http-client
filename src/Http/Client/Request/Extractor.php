<?php

declare(strict_types=1);

namespace Http\Client\Request;

use Http\Client\Request\Payload\Builder as PayloadBuilder;
use Http\Client\Request\Url\Builder as UrlBuilder;
use Http\Client\Request\Url\Extractor as UrlExtractor;
use InvalidArgumentException;
use JsonException;

/**
 * Class Extractor.
 *
 * Responsible for extracting Request URL and options.
 */
class Extractor
{
    /**
     * Build URL and payload then extract them to build Request instance.
     *
     * @param string $method
     * @param string $url
     * @param array $payload
     *
     * @return string[]
     *
     * @throws JsonException When payload JSON decoded fails.
     * @throws InvalidArgumentException When URL is in wrong format and unable to be parsed.
     */
    public static function execute(string $method, string $url, array $payload): array
    {
        $endpoint = UrlBuilder::execute($method, $url, $payload);
        $arrayQueryString = UrlExtractor::extractQueryStringFromUrl($url);
        $payload = array_unique(array_merge($arrayQueryString, $payload));
        $encodedPayload = PayloadBuilder::execute($method, $url, $payload);

        return [$endpoint, $encodedPayload];
    }
}
