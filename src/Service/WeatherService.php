<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

class WeatherService
{
    private $client;
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->client = HttpClient::create();
        $this->apiKey = $apiKey;
    }

    /**
     * @return array
     */
    public function getWeather($lat = 43.6047, $lon = 1.4442)
    {
        $response = $this->client->request('GET', 'https://api.darksky.net/forecast/' . $this->apiKey . '/'. $lat.','. $lon.'?units=si&exclude=[minutely].[daily].[alerts].[flags]&lang=fr');
        
        $meteoArray=$response->toArray() ;
        
        return $meteoArray;
    }
}
