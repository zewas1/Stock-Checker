<?php

declare(strict_types=1);

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApiCommunicationService
{
    /**
     * @var string
     */
    private string $token;

    /**
     * @var string
     */
    private string $uri;

    /**
     * @param string $token
     * @param string $uri
     */
    public function __construct(string $token, string $uri)
    {
        $this->token = $token;
        $this->uri = $uri;
    }

    /**
     * @param string $stockSymbol
     *
     * @return string|null
     *
     * @throws GuzzleException
     */
    public function makeApiCall(string $stockSymbol): ?string
    {
        $client = new Client();
        $requestUrl = $this->geRequestUrl($this->token, $this->uri, $stockSymbol);
        $response = $client->request('GET', $requestUrl);

        return $response->getBody()->getContents() ?? null;
    }

    /**
     * @param string $token
     * @param string $uri
     * @param string $stockSymbol
     *
     * @return string
     */
    private function geRequestUrl(string $token, string $uri, string $stockSymbol): string
    {
        return $uri . $stockSymbol . '/quote?token=' . $token;
    }
}