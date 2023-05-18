<?php

declare(strict_types=1);

namespace Http\Client;

/**
 * @interface RequestInterface
 */
interface RequestInterface extends MessageInterface
{
    public const HTTP_METHOD_GET = 'GET';
    public const HTTP_METHOD_HEAD = 'HEAD';
    public const HTTP_METHOD_POST = 'POST';
    public const HTTP_METHOD_PUT = 'PUT';
    public const HTTP_METHOD_PATCH = 'PATCH';
    public const HTTP_METHOD_DELETE = 'DELETE';
    public const HTTP_METHOD_OPTIONS = 'OPTIONS';

    /**
     * Retrieves URL from Request instance.
     *
     * @return string
     */
    public function getUrl(): string;

    /**
     * Defines URL for Request instance.
     *
     * @param string $url
     * @return RequestInterface
     */
    public function setUrl(string $url): RequestInterface;

    /**
     * Retrieves the HTTP method of request.
     *
     * @return string
     */
    public function getMethod(): string;

    /**
     * Defines the HTTP method for request.
     *
     * @param string $method
     * @return RequestInterface
     */
    public function setMethod(string $method): RequestInterface;

    /**
     * Retrieves HTTP stream context options to make request.
     *
     * @return array
     */
    public function getStreamContextOptions(): array;

    /**
     * Defines HTTP stream context options.
     *
     * @param array $options
     * @return RequestInterface
     */
    public function setStreamContextOptions(array $options): RequestInterface;
}
