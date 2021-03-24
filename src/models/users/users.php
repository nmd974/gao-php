<?php

    use App\Connection;

    function loginHandler ($request){
        $db = Connection::getPDO();
        if($db){
            $query = 'SELECT * FROM `admin` WHERE identifiant = :identifiant';
            $sth = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(
                ':identifiant' => $request['identifiant']
            ));
            $data = $sth->fetchAll(PDO::FETCH_OBJ);
            return $data;
        }
    }

