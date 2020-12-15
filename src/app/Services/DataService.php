<?php

/** 
 * The DataService class stores the given coordinates
 * 
 * @author Molnár Kristóf <molnarkristof0@gmail.com>
 */

namespace DTT\Services;

class DataService
{
    /**
     * The latitude coordiante of A point.
     * 
     * @var float
     */
    private $aLatitude;

    /**
     * The longitude coordinate of A point
     * 
     * @var float
     */
    private $aLongitude;

    /**
     * The latitude coordinate of b point.
     * 
     * @var float
     */
    private $bLatitude;

    /**
     * The longitude coordinate of b point.
     * 
     * @var float
     */
    private $bLongitude;

    /**
     * The pairs of request-key and variable names.
     * 
     * @var array
     */
    private $cooridnateKeys;

    /**
     * It stores the error message.
     * 
     * @var string
     */
    private $errorMessage;

    public function __construct()
    {
        $this->cooridnateKeys = [
            'a-point-latitude' => 'aLatitude',
            'a-point-longitude' => 'aLongitude',
            'b-point-latitude' => 'bLatitude',
            'b-point-longitude' => 'bLongitude'
        ];
    }

    /**
     * It initializes the coordiates. Return with false on failure.
     * 
     * @param array $data 
     * @return void 
     */
    public function initCoordiates(array $data) : bool
    {
        $succes = true;
        
        foreach ($this->cooridnateKeys as $key => $variableName) {
            if (empty($data[$key]) || !is_numeric($data[$key])) {
                $succes = false;
                break;
            }
            $this->{$variableName} = (float) $data[$key];
        }

        return $succes;
    }

    /**
     * Get the latitude coordiante of A point.
     *
     * @return  float
     */ 
    public function getALatitude() : float
    {
        return $this->aLatitude;
    }

    /**
     * Get the longitude coordinate of A point
     *
     * @return  float
     */ 
    public function getALongitude() : float
    {
        return $this->aLongitude;
    }

    /**
     * Get the latitude coordinate of b point.
     *
     * @return  float
     */ 
    public function getBLatitude() : float
    {
        return $this->bLatitude;
    }

    /**
     * Get the longitude coordinate of b point.
     *
     * @return  float
     */ 
    public function getBLongitude() : float
    {
        return $this->bLongitude;
    }
}