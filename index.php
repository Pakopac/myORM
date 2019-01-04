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
$cat->name = "abc";
$cat->age = 5;
$cat->owner = "def";

/*$manager->save($cat);*/
/*$manager->edit($cat,1);*/
/*$manager->delete(13);*/
/*$manager->delete(1);*/
/*$manager->selectId(3);*/
/*$manager->selectAll();*/
/*$manager->selectOrderBy('id','ASC');*/
$manager->exists('animals');
//TODO
// on joue davantage
//$vieuxKebab = $manager->giveMe("Kebab", 3);