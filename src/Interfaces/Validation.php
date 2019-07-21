<?php


namespace Saifalbd\CustomModel\Interfaces;



Interface Validation
{


    /**
     * @param array $resources
     * @return bool
     */
    public static function canAssociative(Array $resources):bool;

    /**
     * @param array $resources
     * @return bool
     */
    public static function canSequential(Array $resources):bool;

    /**
     * @param array $resources
     * @return mixed
     */
    public static function getAssociative(Array $resources):array ;

    /**
     * @param array $resources
     * @return array
     */
    public static function getSequential(Array $resources):array;


}