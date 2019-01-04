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
        $timestamp_debut = microtime(true);
        $timestamp_fin = microtime(true);
        $time = $timestamp_fin - $timestamp_debut;
        $args = func_get_args();

        $args = func_get_args();
        var_dump($args);
        if (!empty($args) ){
            foreach ($args as $arg) {
                $arg;
                var_dump($arg);
            }
        }
        else{
            $arg= "none";
        }
        $this->logRequest($query, $time, $arg);
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
        $query='UPDATE '.$this->getTable().' SET '.$listSet.' WHERE id='.$id.'';
        $req = $this->getConnexion()->exec($query);
        $timestamp_debut = microtime(true);
        $timestamp_fin = microtime(true);
        $time = $timestamp_fin - $timestamp_debut;
        $args = func_get_args();
        var_dump($args);
        if (!empty($args) ){
            foreach ($args as $arg) {
                $arg;
                var_dump($arg);
            }
        }
        else{
            $arg= "none";
        }
        $this->logRequest($query, $time, $arg);
        return $req;
    }
    public function delete($id){
        $query='DELETE FROM '.$this->getTable().' WHERE id='.$id.'';
        $req = $this->getConnexion()->exec($query);
        $timestamp_debut = microtime(true);
        $timestamp_fin = microtime(true);
        $time = $timestamp_fin - $timestamp_debut;
        $args = func_get_args();
        var_dump($args);
        if (!empty($args) ){
            foreach ($args as $arg) {
                $arg;
                var_dump($arg);
            }
        }
        else{
            $arg= "none";
        }

        $this->logRequest($query, $time, $arg);
        return $req;
    }

    public function selectId($id){
        $query='SELECT * FROM '.$this->getTable().' WHERE id='.$id.'';
        $req = $this->getConnexion()->query($query);
        $req->execute();
        $results = $req->fetchAll();
        $timestamp_debut = microtime(true);
        $timestamp_fin = microtime(true);
        $time = $timestamp_fin - $timestamp_debut;
        $args = func_get_args();
        var_dump($args);
        if (!empty($args) ){
            foreach ($args as $arg) {
                $arg;
                var_dump($arg);
            }
        }
        else{
            $arg= "none";
        }
        $this->logRequest($query, $time, $arg);
        return $results;
    }
    public function selectAll(){
        $query='SELECT * FROM '.$this->getTable().' ';
        $req = $this->getConnexion()->query($query);
        $req->execute();
        $results = $req->fetchAll();
        $timestamp_debut = microtime(true);
        $timestamp_fin = microtime(true);
        $time = $timestamp_fin - $timestamp_debut;

        $args = func_get_args();
        var_dump($args);
        if (!empty($args) ){
            foreach ($args as $arg) {
                $arg;
                var_dump($arg);
            }
        }
        else{
            $arg= "none";
        }
        $this->logRequest($query, $time, $arg);
        return $results;
    }
    public function selectOrderBy($columnName,$order){

        $query='SELECT * FROM '.$this->getTable().' ORDER BY '.$columnName.' '.$order.'';
        $req = $this->getConnexion()->query($query);
        $req->execute();
        $results = $req->fetchAll();
        $timestamp_debut = microtime(true);
        $timestamp_fin = microtime(true);
        $time = $timestamp_fin - $timestamp_debut;
        /*$param = var_dump($columnName,$order);*/
        /*$param =  func_get_args();
        echo func_get_arg(0);*/
        $args = func_get_args();
        var_dump($args);
        if (!empty($args) ){
            foreach ($args as $arg) {
               $args;
            }
        }
        else{
            $arg= "none";
        }
        $this->logRequest($query, $time, $arg);
        return $results;
    }


    public function exists($table)
    {

        $query = "SELECT *" ." FROM " . $table  ;
        $req = $this->getConnexion()->query($query);

        $timestamp_debut = microtime(true);
        $timestamp_fin = microtime(true);
        $time = $timestamp_fin - $timestamp_debut;
        $args = func_get_args();
       /* var_dump($args);*/
        if (!empty($args) ){
            foreach ($args as $arg) {
                $args;
            }
        }
        else{
            $arg= "none";
        }
        $this->logRequest($query, $time, $arg);
        var_dump(!empty($req));
        return !empty($req);

    }


    function logRequest($query, $time, $arg_list){
        date_default_timezone_set('Europe/Paris');
        $filePath =  "request.log";
        $fp = fopen($filePath, "a+");
        fputs($fp, "[".date('d/m/Y à H:i:s',time())."]" . "\"" . $query . "\"" . " ".'| Exécution du script : ' . $time . ' secondes.' .' parameter : ' .$arg_list .PHP_EOL);
        fclose($fp);
    }
}