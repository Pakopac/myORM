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
$manager->logRequest($manager->save($cat)['query']);
$manager->logRequest($manager->edit($cat,1)['query']);
/*$manager->delete(13);*/
$manager->logRequest($manager->delete(1)['query']);
$manager->logRequest($manager->selectId(3)['query']);
$manager->logRequest($manager->selectAll()['query']);
/*$manager->selectOrderBy('id','ASC');*/
$manager->logRequest($manager->selectOrderBy('id','ASC')['query']);
//TODO
// on joue davantage
//$vieuxKebab = $manager->giveMe("Kebab", 3);