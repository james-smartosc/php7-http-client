<?php

declare(strict_types=1);

namespace Http\Client\Request\Url;

use Http\Client\Request\RequestDataBuilderInterface;
use InvalidArgumentException;

/**
 * Class Converter.
 *
 * Responsible for converting URL.
 */
class Converter
{
    /**
     * Convert absolute URL to URL Parts in order to fetch query string from parts.
     *
     * @param string $url
     *
     * @return array
     *
     * @throws InvalidArgumentException When URL is in the wrong format to be parsed.
     */
    public static function convertUrlToParts(string $url): array
    {
        $urlParts = parse_url($url);

        if (!$urlParts) {
            throw new InvalidArgumentException(
                sprintf('The URL "%s" is in the wrong format.', $url)
            );
        }

        return $urlParts;
    }

    /**
     * Convert URL to URL without query string.
     * Remove the query string of URL.
     * Support for GET/HEAD/OPTIONS methods to rebuild query string with data in payload if exists.
     * Support for POST/PUT/PATCH methods in order to move them to the payload.
     *
     * @param string $url
     * @return string
     */
    public static function convertUrlRemoveQueryString(string $url): string
    {
        return strtok($url, RequestDataBuilderInterface::URL_QUERY_SEPARATOR);
    }
}
