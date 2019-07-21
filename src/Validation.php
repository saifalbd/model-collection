<?php


namespace Saifalbd\CustomModel;


class Validation implements \Saifalbd\CustomModel\Interfaces\Validation
{

    /**
     * @param array $resources
     * @return bool
     */
    public static function canAssociative(Array $resources):bool{
        return array_keys($resources) !== range(0, count($resources) - 1);
    }

    /**
     * @param array $resources
     * @return bool
     */
    public static function canSequential(Array $resources):bool{

        return array_keys($resources) !== range(0, count($resources) - 1)?false:true;
    }

    /**
     * @param array $resources
     * @return array
     */
    public static function getAssociative(Array $resources):array {
        $ass = static::canAssociative($resources);
        $arr = [];
        if ($ass):
            $arr =  $resources;
        else:
            throw new \LogicException('resources not are Associative only allow Associative Array');


        endif;

        return $arr;
    }

    /**
     * @param array $resources
     * @return array
     */
    public static function getSequential(Array $resources):array {
        $sequential = static::canSequential($resources);
        $arr = [];
        if ($sequential):
            $arr = $resources;
        else:
            throw new \LogicException('resources not are Sequential/indexed array only allow Sequential/indexed Array');


        endif;

        return $arr;


    }

}