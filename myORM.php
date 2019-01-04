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
    public function setQuery($query){
        return $this -> query = $query;
    }
    public function getQuery(){
        return $this -> query;
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
        $this->logRequest($query);
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
        $this->logRequest($query);
        return $req;
    }
    public function delete($id){
        $query='DELETE FROM '.$this->getTable().' WHERE id='.$id.'';
        $req = $this->getConnexion()->exec($query);
        /* var_dump($req);*/
        $this->logRequest($query);
        return $req;
    }
    public function selectId($id){
        $query='SELECT * FROM '.$this->getTable().' WHERE id='.$id.'';
        $req = $this->getConnexion()->query($query);
        $req->execute();
        $results = $req->fetchAll();
        echo "<pre>",var_dump($results),"</pre>";
        $this->logRequest($query);
        return $results;
    }
    public function select(){
        $query='SELECT * FROM '.$this->getTable().' ';
        return $this->setQuery($query);
    }
    public function where($condition){
        $query = $this->getQuery();
        $explode = explode('=',$condition);
        $condition = $explode[0].'="'.($explode[1]).'"';
        $query=$query.' WHERE '.$condition.'';
        return $this->setQuery($query);
    }
    public function orderBy($columnName,$order){
        $query = $this->getQuery();
        $query=$query.' ORDER BY '.$columnName.' '.$order.'';
        return $this->setQuery($query);
    }
    public function execute(){
        $query = $this->getQuery();
        $req = $this->getConnexion()->query($query);
        $req->execute();
        $results = $req->fetchAll();
        $this->logRequest($query);
        echo "<pre>",var_dump($results),"</pre>";
        return $results;
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