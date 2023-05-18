<?php

declare(strict_types=1);

namespace Http\Client\Request;

use Http\Client\MessageInterface;
use Http\Client\Request\Checker as RequestChecker;
use Http\Client\RequestInterface;

/**
 * Class Resolver
 *
 * Responsible for resolving Request data.
 */
class Resolver
{
    /**
     * Resolves request headers if not passed when creating.
     *
     * @param RequestInterface $request
     * @return RequestInterface
     */
    public static function resolveHeaders(RequestInterface $request): RequestInterface
    {
        if (!$request->hasHeader(MessageInterface::HEADER_ACCEPT_KEY)) {
            $request->setHeader(
                MessageInterface::HEADER_ACCEPT_KEY,
                MessageInterface::HEADER_APPLICATION_JSON
            );
        }

        if (RequestChecker::isApplicableForRequestBody($request->getMethod())
            && !$request->hasHeader(MessageInterface::HEADER_CONTENT_TYPE_KEY)
        ) {
            $request->setHeader(
                MessageInterface::HEADER_CONTENT_TYPE_KEY,
                MessageInterface::HEADER_APPLICATION_JSON
            );
        }

        $request->setHeader(MessageInterface::HEADER_CONTENT_LENGTH_KEY, (string)strlen($request->getBody()));

        return $request;
    }

    /**
     * Resolves the stream context options for sending HTTP requests.
     *
     * @param RequestInterface $request
     * @return RequestInterface
     */
    public static function resolveStreamContextOptions(RequestInterface $request): RequestInterface
    {
        $headers = [];

        foreach ($request->getHeaders() as $headerKey => $headerValue) {
            $headers[] = sprintf('%s: %s', $headerKey, $headerValue);
        }

        $options = [
            RequestBuilderInterface::STREAM_CONTEXT_HTTP_KEY => [
                RequestBuilderInterface::STREAM_CONTEXT_HTTP_METHOD_KEY => $request->getMethod(),
                RequestBuilderInterface::STREAM_CONTEXT_HTTP_HEADER_KEY => implode(
                    RequestBuilderInterface::STREAM_CONTEXT_HEADER_DELIMITER,
                    $headers
                ),
                RequestBuilderInterface::STREAM_CONTEXT_HTTP_CONTENT_KEY => $request->getBody(),
                MessageInterface::HTTP_PROTOCOL_VERSION_KEY => $request->getProtocolVersion()
            ]
        ];

        $request->setStreamContextOptions($options);

        return $request;
    }
}
