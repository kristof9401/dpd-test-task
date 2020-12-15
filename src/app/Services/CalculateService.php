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
        return $this->DataService->getALongitude() . "; " . $this->DataService->getBLatitude();
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
}