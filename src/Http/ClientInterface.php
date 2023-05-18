<?php

declare(strict_types=1);

namespace Http;

use Http\Client\RequestInterface;
use Http\Client\ResponseInterface;
use Http\Exception\HttpExceptionInterface;
use InvalidArgumentException;
use JsonException;

/**
 * @interface ClientInterface
 */
interface ClientInterface
{
    /**
     * @param string $url
     * @param array $query
     * @param array $headers
     *
     * @return ResponseInterface
     *
     * @throws InvalidArgumentException When status code not in range or headers not contains required HTTP response data.
     * @throws HttpExceptionInterface When response fails on validation.
     */
    public static function get(string $url, array $query = [], array $headers = []): ResponseInterface;

    /**
     * @param string $url
     * @param array $query
     * @param array $headers
     *
     * @return ResponseInterface
     *
     * @throws InvalidArgumentException When status code not in range or headers not contains required HTTP response data.
     * @throws HttpExceptionInterface When response fails on validation.
     */
    public static function head(string $url, array $query = [], array $headers = []): ResponseInterface;

    /**
     * @param string $url
     * @param array $payload
     * @param array $headers
     *
     * @return ResponseInterface
     *
     * @throws InvalidArgumentException When status code not in range or headers not contains required HTTP response data.
     * @throws JsonException When payload JSON decoded fails.
     * @throws HttpExceptionInterface When response fails on validation.
     */
    public static function post(string $url, array $payload = [], array $headers = []): ResponseInterface;

    /**
     * @param string $url
     * @param array $payload
     * @param array $headers
     *
     * @return ResponseInterface
     *
     * @throws InvalidArgumentException When status code not in range or headers not contains required HTTP response data.
     * @throws JsonException When payload JSON decoded fails.
     * @throws HttpExceptionInterface When response fails on validation.
     */
    public static function put(string $url, array $payload = [], array $headers = []): ResponseInterface;

    /**
     * @param string $url
     * @param array $payload
     * @param array $headers
     *
     * @return ResponseInterface
     *
     * @throws InvalidArgumentException When status code not in range or headers not contains required HTTP response data.
     * @throws JsonException When payload JSON decoded fails.
     * @throws HttpExceptionInterface When response fails on validation.
     */
    public static function patch(string $url, array $payload = [], array $headers = []): ResponseInterface;

    /**
     * @param string $url
     * @param array $query
     * @param array $headers
     *
     * @return ResponseInterface
     *
     * @throws InvalidArgumentException When status code not in range or headers not contains required HTTP response data.
     * @throws HttpExceptionInterface When response fails on validation.
     */
    public static function delete(string $url, array $query = [], array $headers = []): ResponseInterface;

    /**
     * @param string $url
     * @param array $query
     * @param array $headers
     *
     * @return ResponseInterface
     *
     * @throws InvalidArgumentException When status code not in range or headers not contains required HTTP response data.
     * @throws HttpExceptionInterface When response fails on validation.
     */
    public static function options(string $url, array $query = [], array $headers = []): ResponseInterface;

    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     *
     * @throws InvalidArgumentException When status code not in range or headers not contains required HTTP response data.
     * @throws HttpExceptionInterface When response fails on validation.
     */
    public static function sendRequest(RequestInterface $request): ResponseInterface;
}
