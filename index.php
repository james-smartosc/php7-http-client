<?php

declare(strict_types=1);

require_once __DIR__ . '/autoload.php';

use Http\Client;
use Http\Client\ResponseInterface;
use Http\Exception\MethodNotSupportedException;

Autoloader::register();

function getAuthenticationToken(): ResponseInterface
{
    $response = Client::options('https://corednacom.corewebdna.com/assessment-endpoint.php');

    doPrintOutputResponse($response);

    return $response;
}

function submitCustomAssessment(): void
{
    try {
        $authTokenResponse = getAuthenticationToken();

        $response = Client::post(
            'https://corednacom.corewebdna.com/assessment-endpoint.php',
            [
                'name' => 'James Dinh',
                'email' => 'dungdt4@smartosc.com',
                'url' => 'https://github.com/james-smartosc/php7-http-client',
            ],
            [
                'Authorization' => sprintf('Bearer %s', $authTokenResponse->getBody()),
                'Content-Type' => 'application/json',
            ]
        );

        doPrintOutputResponse($response);
    } catch (Exception $e) {
        doPrintException($e);
    }
}

submitCustomAssessment();

function doPrintException(Exception $e): void
{
    print_r(sprintf('Exception occurred: "%s"', get_class($e)));
    echo PHP_EOL;
    print_r($e->getMessage());
    echo PHP_EOL;
}

function doPrintOutputResponse(ResponseInterface $response): void
{
    print_r('Response headers:');
    echo PHP_EOL;
    print_r($response->getHeaders());
    echo PHP_EOL;
    print_r('Response payload:');
    echo PHP_EOL;

    try {
        $responseBody = $response->getBodyAsArray();
    } catch (MethodNotSupportedException $e) {
        $responseBody = $response->getBody();
    } catch (JsonException $e) {
        doPrintException($e);

        return;
    }

    print_r($responseBody);
}
