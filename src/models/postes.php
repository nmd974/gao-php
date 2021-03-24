<?php

    use App\Connection;

    function getAllPostes (){
        $db = Connection::getPDO();
        $data = false;
        if($db){
            try{
                $query = "SELECT * FROM `postes` WHERE `etat` = 'actif' ORDER BY `created_at` ASC";
                $sth = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute();
                $data = $sth->fetchAll(PDO::FETCH_OBJ);
                return $data;
            }catch(PDOException $e){
                $error = $e->getMessage();
                $_SESSION['flash'] = array('Error', "Echec lors de l'execution de la requete");
                return $data;
            }
        }else{
            $_SESSION['flash'] = array('Error', "Impossible de se connecter au serveur");
            return $data;
        }
    }

