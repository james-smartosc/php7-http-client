<?php

declare(strict_types=1);

namespace Http\Client\Request\Payload;

use Http\Client\Request\Checker as RequestChecker;
use Http\Client\Request\RequestDataBuilderInterface;
use JsonException;

/**
 * Class Builder.
 */
class Builder implements RequestDataBuilderInterface
{
    /**
     * {@inheritdoc}
     *
     * @throws JsonException When JSON encode fails.
     */
    public static function execute(string $method, string $url, array $payload = []): string
    {
        if (!RequestChecker::isApplicableForRequestBody($method)) {
            return '';
        }

        return json_encode($payload, JSON_THROW_ON_ERROR);
    }
}
