<?php

declare(strict_types=1);

namespace Http\Client\Response;

use Http\Client\Response;
use Http\Client\Response\Validator as ResponseValidator;
use Http\Client\ResponseInterface;
use Http\Client\Response\Header\Parser as ResponseHeaderParser;
use InvalidArgumentException;

/**
 * Class Builder.
 */
class Builder implements ResponseBuilderInterface
{
    /**
     * @param string $body
     * @param array $httpHeaders
     *
     * @return ResponseInterface
     *
     * @throws InvalidArgumentException If status code not in range or headers not contains required HTTP response data.
     */
    public static function execute(
        string $body,
        array $httpHeaders = []
    ): ResponseInterface {
        $headers = ResponseHeaderParser::execute($httpHeaders);

        ResponseValidator::validateHeaders($headers);
        $status = (int) $headers[ResponseInterface::HTTP_STATUS_CODE_KEY];
        ResponseValidator::validateStatusCode($status);

        return new Response($status, $headers, $body);
    }
}
