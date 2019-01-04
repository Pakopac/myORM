<?php
include("myORM.php");
// définition
$connexion = new PDO("mysql:host=localhost;dbname=myorm", "root", "");
class Animal{
    public $name;
    public $age;
    public $owner;
}
//initialisation
$manager = new castORM();
// 1- on lui passe la BDD (connexion)
$manager->setConnexion($connexion);
// 2- on lui passe les modèles
$manager->addModel("Animal","animals",array("name","age","owner"));
// on joue avec
$cat = new Animal();
$cat->name = "a";
$cat->age = 2;
$cat->owner = "b";
//$manager->save($cat);
//$manager->edit($cat,1);
//$manager->delete(150);
//$manager->selectId(1);
$manager->select();
$manager->where("age=2");
$manager->orderBy("id","DESC");
//$manager->count("*");