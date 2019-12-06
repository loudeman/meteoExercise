<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\WeatherService;

class WeatherController extends AbstractController
{
    private $wheatherService;

    public function __construct(WeatherService $weather)
    {
        $this->weatherService = $weather;
    }

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('weather/index.html.twig', array(
            // ...
        ));
    }
    
    /**
     * @Route("/meteo", name="meteo")
     */
    public function meteo()
    {
        $apiResponse = $this->weatherService->getWeather();
        
        return $this->render('weather/meteo.html.twig', array(
            "meteo"=> $apiResponse
        ));
    }
}
