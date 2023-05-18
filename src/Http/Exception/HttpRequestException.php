<?php

declare(strict_types=1);

namespace Http\Exception;

use Http\Client\RequestInterface;
use Exception;

/**
 * Class HttpRequestException.
 */
class HttpRequestException extends Exception implements HttpExceptionInterface
{
    /**
     * @var RequestInterface
     */
    private RequestInterface $request;

    /**
     * Initialize constructor.
     *
     * @param RequestInterface $request
     * @param string $message
     * @param int $code
     */
    public function __construct(RequestInterface $request, string $message = '', int $code = 0)
    {
        $this->request = $request;

        parent::__construct($message, $code);
    }

    /**
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }
}
