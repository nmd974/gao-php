<?php

    use App\Connection;

    function loginHandler ($request){
        $db = Connection::getPDO();
        $data = false;
        if($db){
            try{
                $query = 'SELECT * FROM `admin` WHERE identifiant = :identifiant';
                $sth = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(
                    ':identifiant' => $request['identifiant']
                ));
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

    function createUser($request){
        $db = Connection::getPDO();
        $data = false;
        if($db){

            try{
                $query = "INSERT INTO `utilisateurs` SET `nom`= :nom, `prenom`=:prenom, `carte_id`=:carte_id, `date_naissance`=:date_naissance";
                $sth = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(
                    ':nom' => $request['nom'],
                    ':prenom' => $request['prenom'],
                    ':carte_id' => $request['carte_id'],
                    ':date_naissance' => $request['date_naissance'],
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

    function updateUser($request){
        $db = Connection::getPDO();
        $data = false;
        if($db){
            try{
                $query = "UPDATE `utilisateurs` SET `nom`= :nom, `prenom`=:prenom, `carte_id`=:carte_id, `date_naissance`=:date_naissance WHERE id=:id";
                $sth = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(
                    ':id' => $request['id'],
                    ':nom' => $request['nom'],
                    ':prenom' => $request['prenom'],
                    ':carte_id' => $request['carte_id'],
                    ':date_naissance' => $request['date_naissance'],
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

    function deleteUser($request){
        $db = Connection::getPDO();
        $data = false;
        if($db){
            try{
                $query = "DELETE FROM `utilisateurs` WHERE id=:id";
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

    function getAllUsers(){
        $db = Connection::getPDO();
        $data = false;
        if($db){
            try{
                $query = "SELECT * FROM `utilisateurs` ORDER BY `nom` ASC";
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

    function searchUser($request){
        $db = Connection::getPDO();
        $data = false;
        if($db){
            try{
                $query = "SELECT * FROM `utilisateurs` 
                WHERE nom LIKE '%$request%'
                OR prenom LIKE '%$request%'
                OR carte_id LIKE '%$request%'
                ORDER BY `nom` ASC";
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

