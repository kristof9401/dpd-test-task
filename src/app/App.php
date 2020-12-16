<?php

/** 
 * The Dpd Test Project App class.
 * 
 * We load other class here.
 * 
 * @author Molnár Kristóf <molnarkristof0@gmail.com>
 */

namespace DTT;

use DTT\Managers\TemplateManager;
use DTT\Services\CalculateService;
use DTT\Services\DataService;
use DTT\Services\ValidatorService;

class App
{
    protected static $instance = null;

    protected function __construct()
    {
        /* Do Nothing. */
    }

    public static function getInstance(): App
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    protected function __clone()
    {
        /* Do Nothing */
    }

    public function __wakeup()
    {
        throw new \Exception('Cannot unserialize a singleton.');
    }

    /**
     * Run the App class
     * 
     * @return mixed 
     */
    public function run()
    {
        $data = [
            'error_msg' => ''
        ];

        if (array_key_exists('gps-coors', $_REQUEST) && is_array($_REQUEST['gps-coors'])) {
            $DataService = new DataService;
            $initDataSuccess = $DataService->initCoordiates(
                $_REQUEST['gps-coors']
            );

            if (!$initDataSuccess) {
                $data['error_msg'] = "The coordinates are not given correctly.";
                $this->loadTemplate($data);
                return false;
            }

            $ValidatorService = new ValidatorService($DataService);

            $ValidatorService->checkCoordinates();

            if (!empty($ValidatorService->getErrorMessage())) {
                $data['error_msg'] .= $ValidatorService->getErrorMessage();
                $this->loadTemplate($data);
                return false;
            }

            $CalculateService = new CalculateService($DataService);

            $data['c_coors'] = $CalculateService->getCPointCoordiantes();
            
            $data['d_coors'] = $CalculateService->getDPointCoordiantes();

            $data['perimeter'] = round($CalculateService->getPerimeter() * 1000, 2);

            $data['area'] = round($CalculateService->getArea() * 1000 * 1000);
        }

        $this->loadTemplate($data);
    }

    /**
     * It loads the TemplateManager class.
     * 
     * @param array $data 
     * @return void 
     */
    public function loadTemplate(array $data) : void
    {
        $TemplateManager = new TemplateManager;

        $TemplateManager->loadForm($data);
    }
}
