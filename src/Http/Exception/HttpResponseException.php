<?php

declare(strict_types=1);

namespace Http\Exception;

use Http\Client\ResponseInterface;
use Exception;

/**
 * Class HttpResponseException.
 */
class HttpResponseException extends Exception implements HttpExceptionInterface
{
    /**
     * @var ResponseInterface
     */
    private ResponseInterface $response;

    /**
     * Initialize constructor.
     *
     * @param ResponseInterface $response
     * @param string $message
     */
    public function __construct(ResponseInterface $response, string $message = '')
    {
        $this->response = $response;

        parent::__construct($message, $response->getStatusCode());
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
