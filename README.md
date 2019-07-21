# PHP Custom Model Collection

if you can want convert array to object or Multidimensional Arrays To Collection like laravel Eloquent Collection 
Then this Package Need for you . you can also call object like Associative Arrays object->key or object['key']

## Getting Started

```
use Saifalbd\CustomModel\Model;
```

### Model Create

#### on non-static method
```
$model = new Model();
$data = $model->add(array("name"=>"John", "email"=>"john@gmail.com", "age"=>33));
```
return object you can access $data["name"] or $data->name
#####you can also add multiple 
```
$collection = $model->add()->add()->add()->get()
```
return object collection you can access $collection[index]->property;

#### on static method
```
$data = Model::make(array("name"=>"John", "email"=>"john@gmail.com", "age"=>33));
```
return object you can access $data["name"] or $data->name

### Collection Create

#### on non-static method
```
$model = new Model();
$collection = $model->addAll(
array("name"=>"Ram", "email"=>"ram@gmail.com", "age"=>23),
    array("name"=>"Shyam", "email"=>"shyam23@gmail.com", "age"=>28),
    array("name"=>"John", "email"=>"john@gmail.com", "age"=>33),
    array("name"=>"Bob", "email"=>"bob32@gmail.com", "age"=>41)
);
```
return object collection you can access $collection[index]->property;


#### on static method
```
$model = new Model();
$collection = $model->makeAll(
array("name"=>"Ram", "email"=>"ram@gmail.com", "age"=>23),
    array("name"=>"Shyam", "email"=>"shyam23@gmail.com", "age"=>28),
    array("name"=>"John", "email"=>"john@gmail.com", "age"=>33),
    array("name"=>"Bob", "email"=>"bob32@gmail.com", "age"=>41)
);
```
return object collection you can access $collection[index]->property;

~~note: if you can use this package for laravel project then call $collection->collection(); return Illuminate\Support\Collection~~
#### model set
```
$model = new Model();
$model->country = 'bangladesh'
```
#### model get
```
$model->country;
or 
$model['country'];
```
#### collection in json
```
$model = new Model();
$json = $model->addAll(MultidimensionalArray)->toJson();
or 
$json = Model::makeAll(MultidimensionalArray)->toJson();
```

### INSTALL

```
composer require saifalbd/model-collection
```


