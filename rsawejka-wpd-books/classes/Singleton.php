<?php


namespace booksPlugin;


/**
 * Class Singleton
 * @package booksPlugin
 */
abstract class Singleton
{
    /**
     * @var $instance the instance of the page
     */
    protected static $instance;

    //make constructor private so objects cannot be created outside of file

    /**
     * Singleton constructor.
     */
    protected function __construct(){}

    //prevent cloning

    private  function __clone(){}

    //method that will create a new instance or return the exsisting one
    //this insures that there will only be one
    /**
     * @return mixed make sure there is a new instance
     */
    public static function getInstance(){
        if(static::$instance == null){
            static::$instance == new static();
        }

        return self::$instance;
    }
}