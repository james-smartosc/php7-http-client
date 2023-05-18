<?php

declare(strict_types=1);

namespace Http\Client\Request\Url;

use Http\Client\Request\Checker as RequestChecker;
use Http\Client\Request\RequestDataBuilderInterface;
use Http\Client\RequestInterface;
use Http\Client\Request\Url\Converter as RequestUrlConverter;
use Http\Client\Request\Url\Extractor as RequestUrlExtractor;
use InvalidArgumentException;

/**
 * Class Builder.
 *
 * Responsible for building URL endpoint.
 */
class Builder implements RequestDataBuilderInterface
{
    /**
     * Build endpoint URL and URL query string based on HTTP method.
     *
     * {@inheritdoc}
     *
     * @throws InvalidArgumentException When URL is in wrong format and unable to be parsed.
     */
    public static function execute(string $method, string $url, array $payload = []): string
    {
        $endpoint = RequestUrlConverter::convertUrlRemoveQueryString($url);

        if (!RequestChecker::isApplicableForRequestBody($method)) {
            $arrayQueryString = RequestUrlExtractor::extractQueryStringFromUrl($url);
            $queryString = self::buildQueryString($arrayQueryString, $payload);

            if ($queryString) {
                $endpoint = sprintf(
                    '%s%s%s',
                    $endpoint,
                    RequestDataBuilderInterface::URL_QUERY_SEPARATOR,
                    $queryString
                );
            }
        }

        return $endpoint;
    }

    /**
     * Build query string from existed query string from URL combines with payload data if exists.
     *
     * @param array $arrayQueryString
     * @param array $payload
     * @return string
     */
    private static function buildQueryString(array $arrayQueryString, array $payload): string
    {
        $payload = array_unique(array_merge($payload, $arrayQueryString));

        return urldecode(http_build_query($payload));
    }
}
