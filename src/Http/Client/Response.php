<?php

declare(strict_types=1);

namespace Http\Client;

use Http\Exception\MethodNotSupportedException;

/**
 * Class Response.
 */
class Response implements ResponseInterface
{
    use MessageTrait;

    /**
     * @var int
     */
    private int $statusCode;

    /**
     * @var string
     */
    private string $reasonPhrase;

    /**
     * @var string[]
     */
    private static array $phraseMap = [
        ResponseInterface::HTTP_CONTINUE => 'Continue',
        ResponseInterface::HTTP_SWITCHING_PROTOCOLS => 'Switching Protocols',
        ResponseInterface::HTTP_PROCESSING => 'Processing',
        ResponseInterface::HTTP_EARLY_HINTS => 'Early Hints',
        ResponseInterface::HTTP_OK => 'OK',
        ResponseInterface::HTTP_CREATED => 'Created',
        ResponseInterface::HTTP_ACCEPTED => 'Accepted',
        ResponseInterface::HTTP_NON_AUTHORITATIVE_INFORMATION => 'Non-Authoritative Information',
        ResponseInterface::HTTP_NO_CONTENT => 'No Content',
        ResponseInterface::HTTP_RESET_CONTENT => 'Reset Content',
        ResponseInterface::HTTP_PARTIAL_CONTENT => 'Partial Content',
        ResponseInterface::HTTP_MULTI_STATUS => 'Multi-Status',
        ResponseInterface::HTTP_ALREADY_REPORTED => 'Already Reported',
        ResponseInterface::HTTP_IM_USED => 'IM Used',
        ResponseInterface::HTTP_MULTIPLE_CHOICES => 'Multiple Choices',
        ResponseInterface::HTTP_MOVED_PERMANENTLY => 'Moved Permanently',
        ResponseInterface::HTTP_FOUND => 'Found',
        ResponseInterface::HTTP_SEE_OTHER => 'See Other',
        ResponseInterface::HTTP_NOT_MODIFIED => 'Not Modified',
        ResponseInterface::HTTP_USE_PROXY => 'Use Proxy',
        ResponseInterface::HTTP_TEMPORARY_REDIRECT => 'Temporary Redirect',
        ResponseInterface::HTTP_PERMANENTLY_REDIRECT => 'Permanent Redirect',
        ResponseInterface::HTTP_BAD_REQUEST => 'Bad Request',
        ResponseInterface::HTTP_UNAUTHORIZED => 'Unauthorized',
        ResponseInterface::HTTP_PAYMENT_REQUIRED => 'Payment Required',
        ResponseInterface::HTTP_FORBIDDEN => 'Forbidden',
        ResponseInterface::HTTP_NOT_FOUND => 'Not Found',
        ResponseInterface::HTTP_METHOD_NOT_ALLOWED => 'Method Not Allowed',
        ResponseInterface::HTTP_NOT_ACCEPTABLE => 'Not Acceptable',
        ResponseInterface::HTTP_PROXY_AUTHENTICATION_REQUIRED => 'Proxy Authentication Required',
        ResponseInterface::HTTP_REQUEST_TIMEOUT => 'Request Timeout',
        ResponseInterface::HTTP_CONFLICT => 'Conflict',
        ResponseInterface::HTTP_GONE => 'Gone',
        ResponseInterface::HTTP_LENGTH_REQUIRED => 'Length Required',
        ResponseInterface::HTTP_PRECONDITION_FAILED => 'Precondition Failed',
        ResponseInterface::HTTP_REQUEST_ENTITY_TOO_LARGE => 'Content Too Large',
        ResponseInterface::HTTP_REQUEST_URI_TOO_LONG => 'URI Too Long',
        ResponseInterface::HTTP_UNSUPPORTED_MEDIA_TYPE => 'Unsupported Media Type',
        ResponseInterface::HTTP_REQUESTED_RANGE_NOT_SATISFIABLE => 'Range Not Satisfiable',
        ResponseInterface::HTTP_EXPECTATION_FAILED => 'Expectation Failed',
        ResponseInterface::HTTP_I_AM_A_TEAPOT => 'I\'m a teapot',
        ResponseInterface::HTTP_MISDIRECTED_REQUEST => 'Misdirected Request',
        ResponseInterface::HTTP_UNPROCESSABLE_ENTITY => 'Unprocessable Content',
        ResponseInterface::HTTP_LOCKED => 'Locked',
        ResponseInterface::HTTP_FAILED_DEPENDENCY => 'Failed Dependency',
        ResponseInterface::HTTP_TOO_EARLY => 'Too Early',
        ResponseInterface::HTTP_UPGRADE_REQUIRED => 'Upgrade Required',
        ResponseInterface::HTTP_PRECONDITION_REQUIRED => 'Precondition Required',
        ResponseInterface::HTTP_TOO_MANY_REQUESTS => 'Too Many Requests',
        ResponseInterface::HTTP_REQUEST_HEADER_FIELDS_TOO_LARGE => 'Request Header Fields Too Large',
        ResponseInterface::HTTP_UNAVAILABLE_FOR_LEGAL_REASONS => 'Unavailable For Legal Reasons',
        ResponseInterface::HTTP_INTERNAL_SERVER_ERROR => 'Internal Server Error',
        ResponseInterface::HTTP_NOT_IMPLEMENTED => 'Not Implemented',
        ResponseInterface::HTTP_BAD_GATEWAY => 'Bad Gateway',
        ResponseInterface::HTTP_SERVICE_UNAVAILABLE => 'Service Unavailable',
        ResponseInterface::HTTP_GATEWAY_TIMEOUT => 'Gateway Timeout',
        ResponseInterface::HTTP_VERSION_NOT_SUPPORTED => 'HTTP Version Not Supported',
        ResponseInterface::HTTP_VARIANT_ALSO_NEGOTIATES_EXPERIMENTAL => 'Variant Also Negotiates',
        ResponseInterface::HTTP_INSUFFICIENT_STORAGE => 'Insufficient Storage',
        ResponseInterface::HTTP_LOOP_DETECTED => 'Loop Detected',
        ResponseInterface::HTTP_NOT_EXTENDED => 'Not Extended',
        ResponseInterface::HTTP_NETWORK_AUTHENTICATION_REQUIRED => 'Network Authentication Required',
    ];

    /**
     * Initialize constructor.
     *
     * @param int $status
     * @param array $headers
     * @param string $bodyContent
     * @param string $protocolVersion
     * @param string $reasonPhrase
     */
    public function __construct(
        int    $status = ResponseInterface::HTTP_OK,
        array  $headers = [],
        string $bodyContent = '',
        string $protocolVersion = MessageInterface::HTTP_PROTOCOL_VERSION_1_1,
        string $reasonPhrase = ''
    ) {
        $this->statusCode = $status;
        $this->bodyContent = $bodyContent;
        $this->protocolVersion = $protocolVersion;

        foreach ($headers as $header => $value) {
            $this->setHeader($header, $value);
        }

        if (!$reasonPhrase && isset(self::$phraseMap[$status])) {
            $this->reasonPhrase = self::$phraseMap[$status];
        } else {
            $this->reasonPhrase = $reasonPhrase;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * {@inheritdoc}
     */
    public function getReasonPhrase(): string
    {
        return $this->reasonPhrase;
    }

    /**
     * {@inheritdoc}
     */
    public function getBodyAsArray(): array
    {
        if (strpos(
            MessageInterface::HEADER_APPLICATION_JSON,
            $this->getHeader(MessageInterface::HEADER_CONTENT_TYPE_KEY)
        ) === false) {
           throw new MethodNotSupportedException(
               'Can not parsed response body to JSON decoded because response was not expected JSON body.'
           );
        }

        return json_decode($this->getBody(), true, 512, JSON_THROW_ON_ERROR);
    }
}
