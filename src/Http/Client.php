<?php

declare(strict_types=1);

namespace Http;

use Http\Client\Request\Builder as RequestBuilder;
use Http\Client\Request\Validator as RequestValidator;
use Http\Client\RequestInterface;
use Http\Client\Response\Builder as ResponseBuilder;
use Http\Client\Response\Validator as ResponseValidator;
use Http\Client\ResponseInterface;

/**
 * Class Client.
 */
class Client implements ClientInterface
{
    /**
     * {@inheritdoc}
     */
    public static function get(string $url, array $query = [], array $headers = []): ResponseInterface
    {
        $request = RequestBuilder::execute(RequestInterface::HTTP_METHOD_GET, $url, $query, $headers);

        return static::sendRequest($request);
    }

    /**
     * {@inheritdoc}
     */
    public static function head(string $url, array $query = [], array $headers = []): ResponseInterface
    {
        $request = RequestBuilder::execute(RequestInterface::HTTP_METHOD_HEAD, $url, $query, $headers);

        return static::sendRequest($request);
    }

    /**
     * {@inheritdoc}
     */
    public static function post(string $url, array $payload = [], array $headers = []): ResponseInterface
    {
        $request = RequestBuilder::execute(RequestInterface::HTTP_METHOD_POST, $url, $payload, $headers);

        return static::sendRequest($request);
    }

    /**
     * {@inheritdoc}
     */
    public static function put(string $url, array $payload = [], array $headers = []): ResponseInterface
    {
        $request = RequestBuilder::execute(RequestInterface::HTTP_METHOD_PUT, $url, $payload, $headers);

        return static::sendRequest($request);
    }

    /**
     * {@inheritdoc}
     */
    public static function patch(string $url, array $payload = [], array $headers = []): ResponseInterface
    {
        $request = RequestBuilder::execute(RequestInterface::HTTP_METHOD_PATCH, $url, $payload, $headers);

        return static::sendRequest($request);
    }

    /**
     * {@inheritdoc}
     */
    public static function delete(string $url, array $query = [], array $headers = []): ResponseInterface
    {
        $request = RequestBuilder::execute(RequestInterface::HTTP_METHOD_DELETE, $url, $query, $headers);

        return static::sendRequest($request);
    }

    /**
     * {@inheritdoc}
     */
    public static function options(string $url, array $query = [], array $headers = []): ResponseInterface
    {
        $request = RequestBuilder::execute(RequestInterface::HTTP_METHOD_OPTIONS, $url, $query, $headers);

        return static::sendRequest($request);
    }

    /**
     * {@inheritdoc}
     */
    public static function sendRequest(RequestInterface $request): ResponseInterface
    {
        RequestValidator::validateRequest($request);
        $context = stream_context_create($request->getStreamContextOptions());
        $resultBody = file_get_contents($request->getUrl(), false, $context);

        $response = ResponseBuilder::execute($resultBody, $http_response_header ?? []);
        ResponseValidator::validateResponse($response);

        return $response;
    }
}
