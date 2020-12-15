<?php

namespace DTT;

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
     * @return void 
     */
    public function run()
    {
        
    }
}
