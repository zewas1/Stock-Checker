<?php

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
    public function __construct(string $token, string $uri){
        $this->token = $token;
        $this->uri = $uri;
    }

    /**
     * @param $stock
     *
     * @return string
     *
     * @throws GuzzleException
     */
    public function makeCall($stock): string
    {
        $token = $this->token;
        $uri = $this->uri;

        $client = new Client();
        $requestUrl = $this->buildUrl($token, $uri, $stock);
        $res = $client->request('GET', $requestUrl);

        return $res->getBody()->getContents();
    }

    /**
     * @param $token
     * @param $uri
     * @param $stock
     *
     * @return string
     */
    private function buildUrl($token, $uri, $stock): string
    {
        return $uri . $stock . '/quote?token=' . $token;
    }
}