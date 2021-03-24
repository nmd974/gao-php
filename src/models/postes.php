<?php

    use App\Connection;

    function getAllPostes (){
        $db = Connection::getPDO();
        if($db){
            $query = "SELECT * FROM `postes` WHERE `etat` = 'actif' ORDER BY `created_at` ASC";
            $sth = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute();
            $data = $sth->fetchAll(PDO::FETCH_OBJ);
            return $data;
        }
    }

