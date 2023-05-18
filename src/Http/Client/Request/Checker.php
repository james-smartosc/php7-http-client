<?php

declare(strict_types=1);

namespace Http\Client\Request;

use Http\Client\RequestInterface;

/**
 * Class Checker.
 *
 * Responsible for checking Request data.
 */
class Checker
{
    /**
     * Check if HTTP method is applicable for accepting request body.
     *
     * @param string $method
     * @return bool
     */
    public static function isApplicableForRequestBody(string $method): bool
    {
        return in_array(
            strtoupper($method),
            [
                RequestInterface::HTTP_METHOD_PUT,
                RequestInterface::HTTP_METHOD_POST,
                RequestInterface::HTTP_METHOD_PATCH
            ]
        );
    }
}
