<?php

/** 
 * The ValidatorService class validates gps coordinates.
 * 
 * It validates the latitude and longitude coordinates and set error message if need.
 * 
 * @author Molnár Kristóf <molnarkristof0@gmail.com>
 */

namespace DTT\Services;

class ValidatorService
{
    /**
     * It stores the coordinates of A and B points.
     * 
     * @var DataService
     */
    private $DataService;

    /**
     * It contains the error message.
     * 
     * @var string
     */
    private $errorMessage;

    public function __construct(DataService $dataService)
    {
        $this->DataService = $dataService;
        $this->errorMessage = '';
    }

    /**
     * Check the coordinates by calling two functions.
     * 
     * @return void 
     */
    public function checkCoordinates() : void
    {
        $this->checkLatitudes();
        $this->checkLongitudes();
    }

    /**
     * It checks the latitudes coordinates are between -90 and 90;
     * 
     * @return void 
     */
    public function checkLatitudes() : void
    {
        if ($this->DataService->getALatitude() < -90 || $this->DataService->getALatitude() > 90) {
            $this->errorMessage .= "The latitude coordinate of A point is invalid\r\n";
        }
        
        if ($this->DataService->getBLatitude() < -90 || $this->DataService->getBLatitude() > 90) {
            $this->errorMessage .= "The latitude coordinate of B point is invalid\r\n";
        }
    }

    /**
     * It checks the longitude coordinates are between -180 and 180;
     * 
     * @return void 
     */
    public function checkLongitudes() : void
    {
        if ($this->DataService->getALongitude() < -180 || $this->DataService->getALongitude() > 180) {
            $this->errorMessage .= "The longitude coordinate of A point is invalid\r\n";
        }
        
        if ($this->DataService->getBLongitude() < -180 || $this->DataService->getBLongitude() > 180) {
            $this->errorMessage .= "The longitude coordinate of B point is invalid\r\n";
        }
    }

    /**
     * It retrieves the error message.
     *
     * @return  string
     */ 
    public function getErrorMessage() : string
    {
        return $this->errorMessage;
    }
}
