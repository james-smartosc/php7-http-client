<?php

declare(strict_types=1);

namespace Http\Client\Request;

use Http\Client\Request;
use Http\Client\Request\Extractor as RequestExtractor;
use Http\Client\Request\Resolver as RequestResolver;
use Http\Client\RequestInterface;

/**
 * Class Builder
 *
 * Initiate Request instance with given URL and options.
 */
class Builder implements RequestBuilderInterface
{
    /**
     * {@inheritdoc}
     */
    public static function execute(
        string $method,
        string $url,
        array  $payload = [],
        array  $headers = []
    ): RequestInterface {
        list($endpoint, $payload) = RequestExtractor::execute($method, $url, $payload);

        $request = new Request($endpoint, $method, $payload, $headers);
        RequestResolver::resolveHeaders($request);
        RequestResolver::resolveStreamContextOptions($request);

        return $request;
    }
}
