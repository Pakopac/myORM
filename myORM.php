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
        $query='INSERT INTO '.$this->getTable().' 
        ('.$listColumns.') VALUES ('.$listValues.')';
        $req = $this->getConnexion()->exec($query);
        $array['query']=$query;
        return $array;
    }

    public function edit($value,$id){
        $listSet = [];
        foreach ($value as $key => $value){
            $value = '"'.$value.'"';
            $set = '' .$key. '=' .$value. '';
            array_push($listSet, $set);
        }
        $listSet = implode(', ',$listSet);
        $query='UPDATE '.$this->getTable().' SET '.$listSet.' WHERE id='.$id.'';
        $req = $this->getConnexion()->exec($query);
        $array['query']=$query;
        return $array;
    }
    public function delete($id){
        $query='DELETE FROM '.$this->getTable().' WHERE id='.$id.'';
        $req = $this->getConnexion()->exec($query);
        $array['query']=$query;
       /* var_dump($req);*/
        return $array;
    }

    public function selectId($id){
        $query='SELECT * FROM '.$this->getTable().' WHERE id='.$id.'';
        $req = $this->getConnexion()->query($query);
        $req->execute();
        $results = $req->fetchAll();
        $array['results']=$results;
        $array['query']=$query;
        /*        var_dump($array);*/

        return $array;
    }
    public function selectAll(){
        $query='SELECT * FROM '.$this->getTable().' ';
        $req = $this->getConnexion()->query($query);
        $req->execute();
        $results = $req->fetchAll();
        $array['results']=$results;
        $array['query']=$query;
        /*        var_dump($array);*/

        return $array;
    }
    public function selectOrderBy($columnName,$order){

        $query='SELECT * FROM '.$this->getTable().' ORDER BY '.$columnName.' '.$order.'';
        $req = $this->getConnexion()->query($query);
        $req->execute();
        $results = $req->fetchAll();
        $array['results']=$results;
        $array['query']=$query;
/*        var_dump($array);*/

        return $array;
    }

    function logRequest($query){
        $date = new DateTime();
        $dateString = $date->format('Y-m-d H:i:s');
        $filePath =  "request.log";
        $fp = fopen($filePath, "a+");
        fputs($fp, "[".date('d/m/Y à H:i:s',time())."]" . "\"" . $query . "\"" .PHP_EOL);
        fclose($fp);
    }
}