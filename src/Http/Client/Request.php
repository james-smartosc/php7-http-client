<?php

declare(strict_types=1);

namespace Http\Client;

/**
 * Class Request.
 */
class Request implements RequestInterface
{
    use MessageTrait;

    /**
     * @var string
     */
    private string $url;

    /**
     * @var string
     */
    private string $method;

    /**
     * @var array
     */
    private array $streamContextOptions = [];

    /**
     * Initialize constructor.
     *
     * @param string $url
     * @param string $method
     * @param string $bodyContent
     * @param string $protocolVersion
     * @param array $headers
     */
    public function __construct(
        string $url,
        string $method,
        string $bodyContent,
        array  $headers = [],
        string $protocolVersion = MessageInterface::HTTP_PROTOCOL_VERSION_1_1
    ) {
        $this->url = $url;
        $this->method = strtoupper($method);
        $this->bodyContent = $bodyContent;
        $this->protocolVersion = $protocolVersion;

        foreach ($headers as $header => $value) {
            $this->setHeader($header, $value);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * {@inheritdoc}
     */
    public function setUrl(string $url): RequestInterface
    {
        $this->url = $url;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * {@inheritdoc}
     */
    public function setMethod(string $method): RequestInterface
    {
        $this->method = strtoupper($method);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getStreamContextOptions(): array
    {
        return $this->streamContextOptions;
    }

    /**
     * {@inheritdoc}
     */
    public function setStreamContextOptions(array $options): RequestInterface
    {
        $this->streamContextOptions = $options;

        return $this;
    }
}