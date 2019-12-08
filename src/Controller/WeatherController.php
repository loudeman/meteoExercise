<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
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
        $request = Request::createFromGlobals();
        $request->getPathInfo();
        $lat= $request->request->get('lat1');
        $lon= $request->request->get('lon0');
        $city= $request->request->get('city');
    
        if ($lat && $lon && $city){
            $meteoApiResponse = $this->weatherService->getWeather($lat,$lon);
        } else{
            $meteoApiResponse = $this->weatherService->getWeather();
            $city = "Toulouse";
        }
        
        
        return $this->render('weather/weather.html.twig', array(
            "meteo"=> $meteoApiResponse,
            "city"=> $city
        ));
    }
}
