<?php
include("castORM.php");

class Animal{
    public $name;
    public $age;
    public $owner;
}

$connexion = new PDO("mysql:host=yourHost;dbname=yourDbname", "user", "password");

$manager = new castORM();
$manager->setConnexion($connexion);
$manager->addModel("Animal","animals",array("name","age","owner"));

$cat = new Animal();
$cat->name = "Bob";
$cat->age = 5;
$cat->owner = "David";
$manager->save($cat);

$cat = new Animal();
$cat->name = "Bob";
$cat->age = 6;
$cat->owner = "David";
$manager->edit($cat,1);

$manager->delete(1);

$manager->selectId(1);

$manager->select();
$manager->where("age=6");
$manager->orderBy("id","DESC");
$manager->execute();

$manager->count();
$manager->where("id=1");
$manager->execute();

$manager->exists();
