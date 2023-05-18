<?php

declare(strict_types=1);

namespace Http\Client\Request\Url;

use Http\Client\Request\RequestDataBuilderInterface;
use Http\Client\Request\Url\Converter as UrlConverter;
use InvalidArgumentException;

/**
 * Class Extractor.
 *
 * Responsible for extracting URL data.
 */
class Extractor
{
    /**
     * Extract array of query string parameters from URL parts.
     * Return empty array if not exists any query string parameter.
     *
     * @param string $url

     * @return array

     * @throws InvalidArgumentException When URL is in the wrong format to be parsed.
     */
    public static function extractQueryStringFromUrl(string $url): array
    {
        $urlParts = UrlConverter::convertUrlToParts($url);
        $queryString = $urlParts[RequestDataBuilderInterface::URL_QUERY_KEY] ?? '';
        parse_str($queryString, $arrayQueryString);

        return $arrayQueryString;
    }
}
