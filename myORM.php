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
    public function save($value){
        $listValues = [];
        foreach ($value as $key => $value){
            array_push($listValues, '"'.$value.'"');
        }
        $listColumns = implode(', ', $this->getColumns());
        $listValues = implode(', ',$listValues);

        $req = $this->getConnexion()->exec('INSERT INTO '.$this->getTable().' 
        ('.$listColumns.') VALUES ('.$listValues.')');
        return $req;
    }
    public function selectId($id){
        $req = $this->getConnexion()->exec('SELECT * FROM '.$this->getTable().' WHERE id='.$id.'');
        var_dump('SELECT * FROM '.$this->getTable().' WHERE id='.$id.'');
        var_dump($req);
        return $req;
    }
    /*public function edit($id){
        $req = $this->getConnexion()->exec('UPDATE animals SET name=\'nn\', age=12,owner=\'OOO\' WHERE id="'.$id.'" ');
        var_dump($req);
        //return $req;
    }*/

}

