<?php


namespace Saifalbd\CustomModel\Interfaces;


interface Collection
{

    /**
     * @param \App\Http\Helper\CustomModel\Model $model
     * @return \App\Http\Helper\CustomModel\Collection
     */
    public static function make(\Saifalbd\CustomModel\Model $model):\Saifalbd\CustomModel\Collection;

    /**
     * @param \App\Http\Helper\CustomModel\Model $model
     * @return \App\Http\Helper\CustomModel\Collection
     */
    public function add(\Saifalbd\CustomModel\Model $model):\Saifalbd\CustomModel\Collection;

    public function collection();
    /**
     * @return array
     */
    public function toArray():array ;

    /**
     * @return string
     */
    public function __toString():string;

    /**
     * @return mixed
     */
    public function __debugInfo();
}