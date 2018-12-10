<?php
class castORM{
    public function addModel($model){
        return $model;
    }
    public function setConnexion($connexion){
        return $this -> connexion = $connexion;
    }
    public function getConnexion(){
        return $this -> connexion;
    }
    public function save($cat){
        var_dump($cat -> name);
        var_dump($cat -> age);
        $req = $this->getConnexion()->exec('INSERT INTO animals (name,age,owner) VALUES ("'.$cat->name.'", "'.$cat->age.'", "'.$cat->owner.'")');
        /*$req -> execute(array(
            "id" => 0,
            "name" => $cat->name,
            "age" => $cat->age,
            "owner" => $cat->owner
        ));*/
        echo 'ok';
        return $req;
    }
}

