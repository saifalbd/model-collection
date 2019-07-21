<?php


namespace Saifalbd\CustomModel\Interfaces;

use  Saifalbd\CustomModel\Model as ModelClass;
use Saifalbd\CustomModel\Collection as CollectionClass;

interface Model
{


    /**
     * @param array $resource
     * @return ModelClass
     */
    public static function make(Array $resource):ModelClass;

    /**
     * @param array $resource
     * @return CollectionClass
     */
    public static function makeAll(Array $resource):CollectionClass;

    /**
     * @param array $resource
     * @return ModelClass
     */
    public function add(Array $resource):ModelClass;

    /**
     * @param array $resource
     * @return CollectionClass
     */
    public function addAll(Array $resource):CollectionClass;

    /**
     * @param array $resource
     * @return ModelClass
     */
    public static function select(Array $resource):ModelClass;

    /**
     * @return CollectionClass
     */
    public static function all():CollectionClass;

    /**
     * @return CollectionClass
     */
    public function get():CollectionClass;


    /**
     * @param string $key
     * @param $val
     * @return ModelClass
     */
    public function setAttribute(string $key,$val):ModelClass;

    public function getAttribute(string $key);

    /**
     * @return array
     */
    public function toArray():array ;

    /**
     * @return array
     */
    public function keys():array;

    /**
     * @return array
     */
    public function values():array;

    /**
     * @param $name
     * @param $value
     * @return mixed
     */
    public function __set($name, $value);

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name);

    /**
     * @return mixed
     */
    public function __toString();

    /**
     * @return mixed
     */
    public function __debugInfo();

}
