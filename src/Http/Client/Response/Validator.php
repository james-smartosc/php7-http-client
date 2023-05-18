<?php

declare(strict_types=1);

namespace Http\Client\Response;

use Http\Client\MessageInterface;
use Http\Client\ResponseInterface;
use Http\Exception\HttpResponseException;
use InvalidArgumentException;

/**
 * Class Validator.
 *
 * Responsible for validating response data.
 */
class Validator
{
    /**
     * @param int $statusCode
     *
     * @throws InvalidArgumentException If status code not in correct range.
     */
    public static function validateStatusCode(int $statusCode): void
    {
        if ($statusCode < 100 || $statusCode >= 600) {
            throw new InvalidArgumentException('Status code must be an integer value between 1xx and 5xx.');
        }
    }

    /**
     * @param array $headers
     *
     * @throws InvalidArgumentException If HTTP response does not contain status code.
     */
    public static function validateHeaders(array $headers): void
    {
        if (!isset($headers[ResponseInterface::HTTP_STATUS_CODE_KEY])) {
            throw new InvalidArgumentException('Response does not contain HTTP status code.');
        }

        if (!isset($headers[MessageInterface::HTTP_PROTOCOL_VERSION_KEY])) {
            throw new InvalidArgumentException('Response does not contain HTTP protocol version.');
        }
    }

    /**
     * @param ResponseInterface $response
     *
     * @throws HttpResponseException If HTTP response status code is 4xx or 5xx.
     */
    public static function validateResponse(ResponseInterface $response): void
    {
        $statusCode = (string) $response->getStatusCode();

        if (strpos($statusCode, '4') || strpos($statusCode, '5')) {
            throw new HttpResponseException(
                $response,
                sprintf(
                    'Error occurred: Response status code "%s" received. Reason was: %s',
                    $statusCode,
                    $response->getReasonPhrase()
                )
            );
        }
    }
}
