<?php

declare(strict_types=1);

namespace Http\Client\Response\Header;

use Http\Client\MessageInterface;
use Http\Client\ResponseInterface;

/**
 * Class Parser.
 *
 * Responsible for parsing headers from response to key value pairs.
 */
class Parser
{
    public const HTTP_HEADER_KEY_VALUE_SEPARATOR = ':';
    public const HTTP_HEADER_PROTOCOL_AND_STATUS_CODE_REGEX_PATTERN = '#HTTP/([0-9.]+)\s+(\d{3})#';

    /**
     * Parses headers from HTTP response header variable after making request.
     * Headers will be parsed into key-value pairs.
     * Parses HTTP protocol version and HTTP status code in order to create Response instance.
     *
     * @param array $httpHeaders
     * @return array
     */
    public static function execute(array $httpHeaders): array
    {
        $headers = [];

        foreach ($httpHeaders as $httpHeader) {
            $keyValuePair = explode(self::HTTP_HEADER_KEY_VALUE_SEPARATOR, $httpHeader, 2);

            if (isset($keyValuePair[0]) && isset($keyValuePair[1])) {
                $headers[trim($keyValuePair[0])] = trim($keyValuePair[1]);

                continue;
            }

            if (preg_match(self::HTTP_HEADER_PROTOCOL_AND_STATUS_CODE_REGEX_PATTERN, $httpHeader, $matches)) {
                $headers[MessageInterface::HTTP_PROTOCOL_VERSION_KEY] = $matches[1] ?? MessageInterface::HTTP_PROTOCOL_VERSION_1_1;
                $headers[ResponseInterface::HTTP_STATUS_CODE_KEY] = $matches[2] ?? ResponseInterface::HTTP_BAD_REQUEST;
            }
        }

        return $headers;
    }
}
