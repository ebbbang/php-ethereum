<?php

namespace Ebbbang\PhpEthereum\Utilities;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;

class RPC
{
    protected Client $client;

    public function __construct(string $rpcUrl)
    {
        if (filter_var($rpcUrl, FILTER_VALIDATE_URL) === false) {
            throw new InvalidArgumentException('RPC URL must be a valid URL');
        }

        $this->client = new Client([
            'base_uri' => $rpcUrl,
            'timeout' => 1.0,
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function callMethod(string $method, array $params)
    {
        $response = $this->client->post('', [
            'json' => [
                "id" => 1,
                "jsonrpc" => "2.0",
                "method" => $method,
                "params" => $params,
            ]
        ]);

        return json_decode($response->getBody()->getContents())->result;
    }
}