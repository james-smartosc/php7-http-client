<?php

declare(strict_types=1);

namespace Http\Client\Request;

use Http\Client\RequestInterface;
use Http\Exception\HttpRequestException;

/**
 * Class Validator.
 *
 * Responsible for validating Request instance before making HTTP request.
 */
class Validator
{
    /**
     * @param RequestInterface $request
     *
     * @throws HttpRequestException If the Request instance instantiation is not in correct way.
     */
    public static function validateRequest(RequestInterface $request): void
    {
        $streamContext = $request->getStreamContextOptions();

        if (!isset($streamContext[RequestBuilderInterface::STREAM_CONTEXT_HTTP_KEY])) {
            throw new HttpRequestException(
                $request,
                'Request was not instantiation correctly. Missing required Stream Context data.'
            );
        }
    }
}
