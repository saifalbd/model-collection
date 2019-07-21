<?php


namespace Saifalbd\CustomModel;
use Saifalbd\CustomModel\Interfaces\Collection as CollectionInterface;
use \ArrayAccess;
use \Iterator;
use \JsonSerializable;

class Collection implements CollectionInterface,ArrayAccess,Iterator,JsonSerializable,\Countable
{
    /**
     * @var int
     * use for Iterator
     */
    private $position = 0;

    /**
     * @var array
     * store indexed array like $items = [[],[]];
     */
    protected static $items = [];


    /**
     * --------------------------------------------------------
     * implements CollectionInterface Interface
     * --------------------------------------------------------
     * more Information @see \App\Http\Helper\CustomModel\Interfaces\Collection
     * --------------------------------------------------------
     */

    /**
     * @param Model $model
     * @return Collection
     */
    public static function make(Model $model):self{

        array_push(static::$items,$model);

        return new static();

    }


    /**
     * @param Model $model
     * @return Collection
     */
    public function add(Model $model): self
    {
        $base = new self();
        array_push($base::$items,$model);
        return $this;
    }


    public function collection(){

        if (function_exists('collect')):
        return collect(self::$items);
        else:

            throw new \Exception('if can use in laravel call collection() method otherwase show fetal error');
            endif;
}
    /**
     * @return \Illuminate\Support\Collection
     */
    public function toArray(): array
    {
        return array_map(function ($item){
            /**
             * toArray() model Methoods
             */
            if (is_array($item)){
                return $item;
            }elseif (is_a($item,Model::class)){
                if (method_exists(Model::class,'toArray')){
                    return $item->toArray();
                }else{
                    throw new \LogicException(Model::class.' toArray Method not exists');
                }

            }else{
                return $item;
            }

        },self::$items);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return \json_encode($this->toArray());
    }


    public function __debugInfo(){

        return [
            "items:protected" => static::$items
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
        return count(static::$items);
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
            static::$items[] = $value;
        } else {
            static::$items[$offset] = $value;
        }
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset) {

        return isset(static::$items[$offset]);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset) {
        unset(static::$items[$offset]);
    }

    /**
     * @param mixed $offset
     * @return mixed|null
     */
    public function offsetGet($offset) {
        return isset(static::$items[$offset]) ? static::$items[$offset] : null;
    }

    /**
     * --------------------------------------------------------
     * implements Iterator Interface
     * --------------------------------------------------------
     * more Information @see https://php.net/manual/en/class.iterator.php
     * --------------------------------------------------------
     */
    public function rewind() {

        $this->position = 0;
    }

    /**
     * @return mixed
     */
    public function current() {

        return static::$items[$this->position];
    }

    public function key() {

        return $this->position;
    }


    public function next() {

        ++$this->position;
    }

    /**
     * @return bool
     */
    public function valid() {

        return isset(static::$items[$this->position]);
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