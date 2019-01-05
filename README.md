<h1>How to use castORM</h1>

First include this

``` php
include("castORM.php");
```

Add a new class with values you wan't to add at the database like this example:

```php
class Animal{
    public $name;
    public $age;
    public $owner;
}
```

After set up the connexion to the database:

``` php 
$connexion = new PDO("mysql:host=yourHost;dbname=yourDbname", "user", "password");
```

Next initialize castORM:

``` php 
$manager = new castORM();
$manager->setConnexion($connexion);

$manager->addModel("db","table",array("columns"));
/*Example
$manager->addModel("Animal","animals",array("name","age","owner"));*/
```

You can now use the differents features of this ORM:

<h3>Save</h3>

You can use the function save to add a new line in the database:

``` php 
$cat = new Animal();
$cat->name = "Bob";
$cat->age = 5;
$cat->owner = "David";
$manager->save($cat);
```

<h3>Edit</h3>

if you wan't edit a line get the id of line and use the function like that:

``` php
$cat = new Animal();
$cat->name = "Bob";
$cat->age = 6;
$cat->owner = "David";
// 1 is the id of line
$manager->edit($cat,1);
```

<h3>Delete</h3>

``` php
// 1 is the id of line
$manager->delete(1);
```

<h3>Select</h3>
<h5>By Id</h5>

```php
$manager->selectId(1);
```

<h5>Select all</h5>
```php
$manager->select();
$manager->execute();
```

<h5>Select with conditions</h5>
```php
$manager->select();
//one condition
$manager->where("age=6");
//many condition
$manager->where("name=Bob,age=6,owner=David");
$manager->execute();
```
<h5>Select order by</h5>
```php
$manager->select();
$manager->orderBy("id","DESC");
$manager->execute();
```
<h5>Select with conditions order by</h5>
```php
$manager->select();
$manager->where("age=6");
$manager->orderBy("id","DESC");
$manager->execute();
```

<h3>Count</h3>

<h5>Count all</h5>
```php
$manager->count();
$manager->execute();
```
<h5>Count with conditions</h5>
```php
$manager->count();
$manager->where("age=6");
$manager->execute();
```

<h3>Exists</h3>

Check if value exist:
```php
$manager->exists();
```
