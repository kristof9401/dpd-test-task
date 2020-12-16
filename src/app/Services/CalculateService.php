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

    /**
     * It conatins the data of building elements.
     * 
     * @var array
     */
    private $config;

    public function __construct(DataService $dataService)
    {
        $this->DataService = $dataService;

        $configPath = DTT_SRC_ROOT . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'config'. DIRECTORY_SEPARATOR . 'default.php';

        if (file_exists($configPath)) {
            $this->config = require_once $configPath;
        } else {
            $this->config = [];
        }
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
     * Get two distances: AC and AD
     * 
     * @return array 
     */
    public function getDistances() : array
    {
        $distance1 = $this->getDistanceInKmBetweenTwoGpsCoors(
            $this->DataService->getALatitude(),
            $this->DataService->getALongitude(),
            $this->DataService->getBLatitude(),
            $this->DataService->getALongitude()
        );
        
        $distance2 = $this->getDistanceInKmBetweenTwoGpsCoors(
            $this->DataService->getALatitude(),
            $this->DataService->getALongitude(),
            $this->DataService->getALatitude(),
            $this->DataService->getBLongitude()
        );

        return [$distance1, $distance2];
    }

    /**
     * It retrieves the perimeter of a rectangle 'A, B, C and D' points.
     * 
     * @return float 
     */
    public function getPerimeter() : float
    {
        $distances = $this->getDistances();

        return 2 * ($distances[0] + $distances[1]);
    }

    /**
     * It retrieves the area of rectangle in squarekm.
     * 
     * @return float 
     */
    public function getArea() : float
    {
        $distances = $this->getDistances();

        return $distances[0] * $distances[1];
    }

    /**
     * It calculates the total cost to encircle the area.
     * 
     * @return int 
     */
    public function getCostOfArea() : int
    {
        if (empty($this->config)) {
            /**
             * Config file is not loaded.
             */
            return false;
        }

        $distances = $this->getDistances();

        $totalCost = 0;

        $totalCost += 4 * $this->config['corner']['cost'];
        $totalCost += 4 * $this->config['gate']['cost'];

        /**
         * The total cost of wire and column.
         */
        $wireAndColumnCost = 0;

        foreach ($distances as $currDistance) {
            $columnNeedNumber = 0;
            $wireNeedNumber = 0;
            /**
             * Get distance in meters.
             */
            $currDistance = $currDistance * 1000;

            /**
             * We substract the length of corners.
             */
            $remainDistance = $currDistance -  2 * $this->config['corner']['size'];;

            /**
             * One gate need.
             */
            $remainDistance -= $this->config['gate']['size'];

            /**
             * 2 columns belong to a gate.
             */
            $remainDistance -= 2 * $this->config['column']['size'];

            /**
             * Round up number of wire because we can not buy half of it.
             */
            $wireNeedNumber = ceil($remainDistance / $this->config['wire']['size']);

            /**
             * The number of columns is half of number of wire, because one column connect two wire.
             */
            $columnNeedNumber = intval($wireNeedNumber / 2);

            $remainDistance -= $columnNeedNumber * $this->config['column']['size'];

            $wireNeedNumber = ceil($remainDistance / $this->config['wire']['size']);

            /**
             * We add plus 2 columns because the gate needs them.
             */
            $wireAndColumnCost += ($columnNeedNumber + 2) * $this->config['column']['cost'] + $wireNeedNumber * $this->config['wire']['cost'];
        }

        $totalCost = $totalCost + 2 * $wireAndColumnCost;

        return $totalCost;
    }
}
