<?php

declare(strict_types=1);

namespace Http\Client;

/**
 * Trait MessageTrait.
 *
 * Trait implementing functionality for Request and Response following MessageInterface.
 */
trait MessageTrait
{
    /**
     * @var array
     */
    private array $headers = [];

    /**
     * @var string
     */
    private string $bodyContent;

    /**
     * @var string
     */
    private string $protocolVersion = '1.1';

    /**
     * {@inheritdoc}
     */
    public function getProtocolVersion(): string
    {
        return $this->protocolVersion;
    }

    /**
     * {@inheritdoc}
     */
    public function setProtocolVersion(string $protocolVersion): MessageInterface
    {
        $this->protocolVersion = $protocolVersion;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * {@inheritdoc}
     */
    public function getHeader(string $header): ?string
    {
        $header = strtolower($header);

        if (!$this->hasHeader($header)) {
            return null;
        }

        return $this->headers[$header];
    }

    /**
     * {@inheritdoc}
     */
    public function hasHeader(string $header): bool
    {
        return isset($this->headers[strtolower($header)]);
    }

    /**
     * {@inheritdoc}
     */
    public function setHeader(string $header, string $value): MessageInterface
    {
        $this->headers[strtolower($header)] = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBody(): string
    {
        return $this->bodyContent;
    }
}
