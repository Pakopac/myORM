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
    public function setTime($time){
        return $this -> time = $time;
    }
    public function getTime(){
        return $this -> time;
    }
    public function save($value){

        $listValues = [];
        foreach ($value as $key => $value){
            array_push($listValues, '"'.$value.'"');
        }
        $listColumns = implode(', ', $this->getColumns());
        $listValues = implode(', ',$listValues);

        $timestamp_start = microtime(true);
        $query='INSERT INTO '.$this->getTable().' 
        ('.$listColumns.') VALUES ('.$listValues.')';
        $req = $this->getConnexion()->exec($query);
        $timestamp_end = microtime(true);
        $time = $timestamp_end - $timestamp_start;

        $args = func_get_args();
        $arg_list = [];
        if (!empty($args)){
            foreach ($args as $arg) {
                array_push($arg_list,$arg);
            }
        }
        $this->logRequest($query, $time, $arg_list);
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

        $timestamp_start = microtime(true);
        $query='UPDATE '.$this->getTable().' SET '.$listSet.' WHERE id='.$id.'';
        $req = $this->getConnexion()->exec($query);
        $timestamp_end = microtime(true);
        $time = $timestamp_end - $timestamp_start;

        $args = func_get_args();
        $arg_list = [];
        if (!empty($args)){
            foreach ($args as $arg) {
                array_push($arg_list,$arg);
            }
        }
        $this->logRequest($query, $time, $arg_list);
        return $req;
    }
    public function delete($id){

        $timestamp_start = microtime(true);
        $query='DELETE FROM '.$this->getTable().' WHERE id='.$id.'';
        $req = $this->getConnexion()->exec($query);
        $timestamp_end = microtime(true);
        $time = $timestamp_end - $timestamp_start;

        $args = func_get_args();
        $arg_list = [];
        if (!empty($args)){
            foreach ($args as $arg) {
                array_push($arg_list,$arg);
            }
        }
        $this->logRequest($query, $time, $arg_list);
        return $req;
    }

    public function selectId($id){

        $timestamp_start = microtime(true);
        $query='SELECT * FROM '.$this->getTable().' WHERE id='.$id.'';
        $req = $this->getConnexion()->query($query);
        $req->execute();
        $results = $req->fetchAll();
        $timestamp_end = microtime(true);
        $time = $timestamp_end - $timestamp_start;

        $args = func_get_args();
        $arg_list = [];
        if (!empty($args) ){
            foreach ($args as $arg) {
                array_push($arg_list,$arg);
            }
        }
        $this->logRequest($query, $time, $arg_list);
        echo "<pre>",var_dump($results),"</pre>";
        return $results;
    }
    public function select(){
        $query='SELECT * FROM '.$this->getTable().' ';
        return $this->setQuery($query);
    }
    public function where($condition){
        $list = [];
        $query = $this->getQuery();
        $separate = explode(',',$condition);
        $explode = explode('=',$separate[0]);
        $separate[0] = $explode[0].'="'.($explode[1]).'"';
        $query=$query.' WHERE '.$separate[0].'';
        if(count($separate) > 1) {
            for ($i = 1; $i < count($separate); $i++) {
                $explode = explode('=',$separate[$i]);
                $separate[$i] = $explode[0].'="'.($explode[1]).'"';
                $query .= ' AND ' . $separate[$i] . '';
            }
        }
        return $this->setQuery($query);
    }
    public function orderBy($columnName,$order){
        $query = $this->getQuery();
        $query=$query.' ORDER BY '.$columnName.' '.$order.'';
        return $this->setQuery($query);
    }
    public function count(){
        $query = 'SELECT COUNT(*) FROM ' . $this->getTable() .'';
        return $this->setQuery($query);
    }
    public function execute(){

        $timestamp_start = microtime(true);
        $query = $this->getQuery();
        $req = $this->getConnexion()->query($query);
        $req->execute();
        $timestamp_end = microtime(true);
        $time = $timestamp_end - $timestamp_start;

        $results = $req->fetchAll();
        $args = func_get_args();
        $arg_list = [];
        if (!empty($args)){
            foreach ($args as $arg) {
                array_push($arg_list,$arg);
            }
        }
        $this->logRequest($query, $time, $arg_list);
        echo "<pre>",var_dump($results),"</pre>";
        return $results;
    }
    public function exists(){

        $timestamp_debut = microtime(true);
        $query = "SELECT *" ." FROM " . $this->getTable()  ;
        $req = $this->getConnexion()->query($query);
        $timestamp_fin = microtime(true);
        $time = $timestamp_fin - $timestamp_debut;
        $args = func_get_args();
        $arg_list = [];
        if (!empty($args)){
            foreach ($args as $arg) {
                array_push($arg_list,$arg);
            }
        }
        $this->logRequest($query, $time, $arg_list);
        return $req;
    }

    function logRequest($query, $time, $arg_list){
        $arg_list = implode(', ',$arg_list);
        date_default_timezone_set('Europe/Paris');
        $filePath =  "request.log";
        $fp = fopen($filePath, "a+");
        fputs($fp, "[".date('d/m/Y à H:i:s',time())."]" . "\"" . $query . "\"" . " ".'| Exécution du script : ' . $time . ' secondes.' .' parameter : ' .$arg_list .PHP_EOL);
        fclose($fp);
    }
}