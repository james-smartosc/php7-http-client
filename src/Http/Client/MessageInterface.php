<?php

declare(strict_types=1);

namespace Http\Client;

/**
 * Interface MessageInterface.
 *
 * Common interface for Request and Response.
 */
interface MessageInterface
{
    public const HEADER_ACCEPT_KEY = 'Accept';
    public const HEADER_CONTENT_TYPE_KEY = 'Content-Type';
    public const HEADER_CONTENT_LENGTH_KEY = 'Content-Length';
    public const HEADER_APPLICATION_JSON = 'application/json';
    public const HTTP_PROTOCOL_VERSION_KEY = 'protocol_version';
    public const HTTP_PROTOCOL_VERSION_1_1 = '1.1';

    /**
     * Retrieves body content.
     *
     * @return string
     */
    public function getBody(): string;

    /**
     * Retrieves HTTP protocol version.
     *
     * @return string
     */
    public function getProtocolVersion(): string;

    /**
     * Defines HTTP protocol version.
     *
     * @param string $protocolVersion
     * @return MessageInterface
     */
    public function setProtocolVersion(string $protocolVersion): MessageInterface;

    /**
     * Retrieves all header key-value pairs.
     * The keys represent the header name.
     *
     * @return string[]
     */
    public function getHeaders(): array;

    /**
     * Retrieves header by name.
     * Return null if the header is not existed.
     *
     * @param string $header
     * @return string|null
     */
    public function getHeader(string $header): ?string;

    /**
     * Checks if the header is existed in message or not.
     *
     * @param string $header
     * @return bool
     */
    public function hasHeader(string $header): bool;

    /**
     * Defines and replace message header.
     *
     * @param string $header
     * @param string $value
     * @return MessageInterface
     */
    public function setHeader(string $header, string $value): MessageInterface;
}
