<?php

namespace Hitbtc;

use GuzzleHttp\Client as HttpClient;

class PublicClient
{
    protected $host;
    protected $httpClient;

    public function __construct($demo = false)
    {
        if ($demo) {
            $this->host = 'https://demo-api.hitbtc.com';
        } else {
            $this->host = 'https://api.hitbtc.com';
        }
    }

    /**
     * @return HttpClient
     */
    public function getHttpClient()
    {
        if (!$this->httpClient) {
            $this->httpClient = new HttpClient([
                'base_uri' => $this->host,
            ]);
        }

        return $this->httpClient;
    }

    public function getTicker($ticker)
    {
        return json_decode($this->getHttpClient()->get('/api/2/public/ticker/' . $ticker)->getBody(), true);
    }


    public function getTickers()
    {
        return json_decode($this->getHttpClient()->get('/api/2/public/ticker')->getBody(), true);
    }

    public function getOderBook($ticker, $limit = 20)
    {
        return json_decode($this->getHttpClient()->get('/api/2/public/orderbook/' . $ticker, [
            'query' => [
                'limit' => $limit
            ]
        ])->getBody(), true);
    }
}
