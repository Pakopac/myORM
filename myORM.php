<?php
class castORM{
    public function addModel($db,$table,$columns){
        $this -> db = $db;
        $this -> table = $table;
        $this -> columns = $columns;
    }
    public function getDb(){
        return $this -> db;
    }
    public function getTable(){
        return $this -> table;
    }
    public function getColumns(){
        return $this -> columns;
    }
    public function setConnexion($connexion){
        return $this -> connexion = $connexion;
    }
    public function getConnexion(){
        return $this -> connexion;
    }
    public function save($cat){
        var_dump($this->getDb());
        var_dump($this->getTable());
        $listColumns = implode("', '", $this->getColumns());
        var_dump($listColumns);
        var_dump($cat->name);

        $req = $this->getConnexion()->exec('INSERT INTO '.$this->getTable().' 
        ("'.$listColumns.'") VALUES ("'.$cat->name.'", "'.$cat->age.'", "'.$cat->owner.'")');
        //echo 'ok';
        return $req;
    }

    public function selectId($id){
        $req = $this->getConnexion()->query('SELECT * FROM '.$this->getTable().' WHERE id="'.$id.'" ');
                                    $req->execute();
        $results = $req->fetchAll();
        return $results;
    }
    //public function edit($id){
      //  $req = $this->getConnexion()->exec('UPDATE animals SET name='nn', age=12,owner='OOO' WHERE id="'.$id.'" ');
        //var_dump($req);
        //return $req;
    //}

}