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

    
    function createPoste($request){
        $db = Connection::getPDO();
        $data = false;
        if($db){

            try{
                $query = "INSERT INTO `postes` SET `description`= :description_poste, `etat`=:etat";
                $sth = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(
                    ':description_poste' => $request['description'],
                    ':etat' => "inactif"
                ));
                $data = $sth->fetchAll(PDO::FETCH_OBJ);
                $data = true;
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

    function updatePoste($request){
        $db = Connection::getPDO();
        $data = false;
        if($db){
            try{
                $query = "UPDATE `postes` SET `description`= :description_poste WHERE id=:id";
                $sth = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(
                    ':id' => $request['id'],
                    ':description_poste' => $request['description']
                ));
                $data = true;
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
    function updateEtatPoste($request){
        $db = Connection::getPDO();
        $data = false;
        if($db){
            try{
                $query = "UPDATE `postes` SET `etat`= :etat WHERE id=:id";
                $sth = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(
                    ':id' => $request['id'],
                    ':etat' => $request['etat']
                ));
                $data = true;
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

    function deletePoste($request){
        $db = Connection::getPDO();
        $data = false;
        if($db){
            try{
                $query = "DELETE FROM `postes` WHERE id=:id";
                $sth = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(
                    ':id' => $request
                ));
                $data = true;
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

    function getAllPostesEtat(){
        $db = Connection::getPDO();
        $data = false;
        if($db){
            try{
                $query = "SELECT * FROM `postes` ORDER BY `id` ASC";
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

    function searchPoste($request){
        $db = Connection::getPDO();
        $data = false;
        if($db){
            try{
                $query = "SELECT * FROM `postes` 
                WHERE `description` LIKE '%$request%'
                OR id LIKE '%$request%'
                ORDER BY `id` ASC";
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
