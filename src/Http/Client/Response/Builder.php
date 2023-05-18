<?php

declare(strict_types=1);

namespace Http\Client\Response;

use Http\Client\Response;
use Http\Client\Response\Header\Parser as ResponseHeaderParser;
use Http\Client\Response\Header\Resolver as ResponseHeaderResolver;
use Http\Client\Response\Validator as ResponseValidator;
use Http\Client\ResponseInterface;

/**
 * Class Builder.
 */
class Builder implements ResponseBuilderInterface
{
    /**
     * {@inheritdoc}
     */
    public static function execute(string $body, array $httpHeaders = []): ResponseInterface
    {
        $headers = ResponseHeaderParser::execute($httpHeaders);

        ResponseValidator::validateHeaders($headers);
        $status = (int)$headers[ResponseInterface::HTTP_STATUS_CODE_KEY];
        ResponseValidator::validateStatusCode($status);
        ResponseHeaderResolver::resolveHeaders($headers);

        return new Response($status, $headers, $body);
    }
}
