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

    public function edit($value,$id){
        $listSet = [];
        foreach ($value as $key => $value){
            $value = '"'.$value.'"';
            $set = '' .$key. '=' .$value. '';
            array_push($listSet, $set);
        }
        $listSet = implode(', ',$listSet);
        $req = $this->getConnexion()->exec('UPDATE '.$this->getTable().' SET '.$listSet.' WHERE id='.$id.'');
        return $req;
    }
    public function delete($id){
        $req = $this->getConnexion()->exec('DELETE FROM '.$this->getTable().' WHERE id='.$id.'');
        return $req;
    }

    public function selectId($id){
        $req = $this->getConnexion()->query('SELECT * FROM '.$this->getTable().' WHERE id='.$id.'');
                                    $req->execute();
        $results = $req->fetchAll();
        return $results;
    }

}