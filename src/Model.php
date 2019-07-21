<?php


namespace Saifalbd\CustomModel;


use ArrayAccess;
use \JsonSerializable;
use Saifalbd\CustomModel\Interfaces\Model as ModelInterface;



class Model implements ModelInterface,JsonSerializable,ArrayAccess,\Iterator,\Countable
{
    protected static $selectKeys =[];
    protected $attributes = [];
    protected $position = 0;





    public function __construct()
    {
        $this->position = 0;
    }
    /**
     * --------------------------------------------------------
     * implements Model Interface
     * --------------------------------------------------------
     * more Information @see \App\Http\Helper\CustomModel\Interfaces\Model
     * --------------------------------------------------------
     */


    private function addData(Array $resource):self {

        $arr = Validation::getAssociative($resource);
        if ($arr):
        $this->attributes = $resource;
        $this->keys = array_keys($resource);
        Collection::make($this);
        endif;
        return $this;
    }

    private function addAllData(Array $resource):Collection{

        $array = Validation::getSequential($resource);
        $collection = new Collection();
        if ($array):

          //  dd(var_dump($resource));
            foreach ($resource as $list){


                $child = Validation::getAssociative($list);

                $this->attributes = $child;

                //$self = new self();
                $collection->add($this);

            }


        endif;
        return  $collection;


    }
    /**
     * @param array $resource
     * @return Model
     */
    public function add(Array $resource):self{

        return $this->addData($resource);
    }


    /**
     * @param array $resource
     * @return Model
     */
    public static function make(Array $resource):self{

        $self = new  self();
       return $self->addData($resource);

    }




    public  static function makeAll(Array $resource):Collection{


        foreach ($resource as $list){
            $self = new self();
            $self->addData($list);
        }




        return new Collection();


    }

    public function addAll(array $resource):Collection
    {

        return $this->addAllData($resource);
    }

    /**
     * @param array $resource
     * @return Model
     */
    public static function select(Array $resource):self {
        return new self();
    }

    /**
     * @return Collection
     */
    public static function all():Collection{

        return new Collection();
    }

    public function toArray():array
    {
        return $this->attributes;
    }

    public function keys():array{
        /**
         * use alll for remove collection instance return array
         */
        return \array_keys($this->toArray());
    }
    public function values():array{
        /**
         * use alll for remove collection instance return array
         */
        return \array_values($this->toArray());
    }

    /**
     * @return Collection
     */
    public function get():Collection{
        return new Collection();
    }



    /**
     * @param string $key
     * @param $val
     * @return Model
     */
    public function setAttribute(string $key,$val):self{
        $this->attributes[$key] = $val;
        return $this;
    }

    /**
     * @param string $key
     */
    public function getAttribute(string $key){
        return $this->attributes[$key];
    }

    /**
     * @return string
     */
    public function __toString(){
        return json_encode($this->toArray());
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value){
        $this->attributes[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name){

        return $this->attributes[$name]??null;
    }


    public function __debugInfo(){
        return [
            'attributes:protected' => $this->attributes
        ];
    }


    /**
     * --------------------------------------------------------
     * implements Countable Interface
     * --------------------------------------------------------
     * more Information @see https://www.php.net/manual/en/class.countable.php
     * --------------------------------------------------------
     */

    public function count()
    {
        return count($this->toArray());
    }

    /**
     * --------------------------------------------------------
     * implements ArrayAccess Interface
     * --------------------------------------------------------
     * more Information @see https://www.php.net/manual/en/class.arrayaccess.php
     * --------------------------------------------------------
     */

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->attributes[] = $value;
        } else {
            $this->attributes[$offset] = $value;
        }
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset) {
        return isset($this->attributes[$offset]);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset) {
        unset($this->attributes[$offset]);
    }

    /**
     * @param mixed $offset
     * @return mixed|null
     */
    public function offsetGet($offset) {
        return isset($this->attributes[$offset]) ? $this->attributes[$offset] : null;
    }





    /**
     * --------------------------------------------------------
     * implements Iterator Interface
     * --------------------------------------------------------
     * more Information @see https://php.net/manual/en/class.iterator.php
     * --------------------------------------------------------
     */



    function rewind() {
        $this->position = 0;
    }

    function current() {
        return $this->toArray()[$this->key()];
    }

    function key() {
        return $this->keys()[$this->position];
    }

    function next() {
        ++$this->position;
    }

    function valid() {
        return isset($this->keys()[$this->position]);
    }

    /**
     * --------------------------------------------------------
     * implements JsonSerializable Interface
     * --------------------------------------------------------
     * more Information @see https://www.php.net/manual/en/class.jsonserializable.php
     * --------------------------------------------------------
     */

    /**
     * @return \Illuminate\Support\Collection|mixed
     * if can call json_encode(self);  then self =jsonSerialize() method call
     */
    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize() {
        return $this->toArray();

    }





}