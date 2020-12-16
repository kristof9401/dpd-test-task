<?php

/** 
 * The CalculateService class does calcualtions with coordinates.
 * 
 * @author Molnár Kristóf <molnarkristof0@gmail.com>
 */

namespace DTT\Services;

class CalculateService
{

    /**
     * It stores the coordinates of A and B points.
     * 
     * @var DataService
     */
    private $DataService;

    public function __construct(DataService $dataService)
    {
        $this->DataService = $dataService;
    }

    /**
     * Get coordinates of C point and concate them as string.
     * 
     * @return string 
     */
    public function getCPointCoordiantes() : string
    {
        return $this->DataService->getBLatitude() . "; " . $this->DataService->getALongitude();
    }
    
    /**
     * Get coordinates of D point and concate them as string.
     * 
     * getDPointCoordiantes
     * @return string 
     */
    public function getDPointCoordiantes() : string
    {
        return $this->DataService->getALatitude() . "; " . $this->DataService->getBLongitude();
    }

    /**
     * It calculates the dictanve in km between two gps coordinates.
     * 
     * @param float $lat1 
     * @param float $lon1 
     * @param float $lat2 
     * @param float $lon2 
     * @return float 
     */
    public function getDistanceInKmBetweenTwoGpsCoors(float $lat1, float $lon1, float $lat2, float $lon2) : float
    {
        $earthRadius = 6371;

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
    
        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * asin(sqrt($a));
        $d = $earthRadius * $c;
    
        return $d;
    }

    /**
     * It retrieves the perimeter of a rectangle 'A, B, C and D' points.
     * 
     * @return float 
     */
    public function getPerimeter() : float
    {
        $distance1 = $this->getDistanceInKmBetweenTwoGpsCoors(
            $this->DataService->getALatitude(),
            $this->DataService->getALongitude(),
            $this->DataService->getBLatitude(),
            $this->DataService->getALongitude()
        );
        
        $distance2 = $this->getDistanceInKmBetweenTwoGpsCoors(
            $this->DataService->getBLatitude(),
            $this->DataService->getBLongitude(),
            $this->DataService->getALatitude(),
            $this->DataService->getBLongitude()
        );

        return 2 * ($distance1 + $distance2);
    }

    public function getArea()
    {
        $distance1 = $this->getDistanceInKmBetweenTwoGpsCoors(
            $this->DataService->getALatitude(),
            $this->DataService->getALongitude(),
            $this->DataService->getBLatitude(),
            $this->DataService->getALongitude()
        );
        
        $distance2 = $this->getDistanceInKmBetweenTwoGpsCoors(
            $this->DataService->getBLatitude(),
            $this->DataService->getBLongitude(),
            $this->DataService->getALatitude(),
            $this->DataService->getBLongitude()
        );

        return $distance1 * $distance2;
    }
}