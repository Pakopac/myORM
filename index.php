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
$manager->addModel("Animal");
// on joue avec
$cat = new Animal();
$cat->name = "Jojo";
$cat->age = 5;
$cat->owner = "Lilian";
$manager->save($cat);
//TODO
// on joue davantage
//$vieuxKebab = $manager->giveMe("Kebab", 3);