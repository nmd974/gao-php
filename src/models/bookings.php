<?php

    use App\Connection;

    function getBookingsByDate ($date_debut_limit, $date_fin_limit){
        $db = Connection::getPDO();
        $data = null;
        if($db){
            try{
                $query = "SELECT * FROM `poste_reserve` INNER JOIN utilisateurs ON utilisateurs.id = poste_reserve.utilisateur_id WHERE `date_debut` BETWEEN :date_debut_limit AND :date_fin_limit";
                $sth = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(
                    ':date_debut_limit' => $date_debut_limit,
                    ':date_fin_limit' => $date_fin_limit
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
    
    function getBookingsByDateByPoste($date_debut_limit, $date_fin_limit, $poste_id){
        $db = Connection::getPDO();
        $data = null;
        if($db){
            try{
                $query = "SELECT * FROM `poste_reserve` INNER JOIN utilisateurs ON utilisateurs.id = poste_reserve.utilisateur_id WHERE `poste_id` = :poste_id AND `date_debut` BETWEEN :date_debut_limit AND :date_fin_limit";
                $sth = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(
                    ':date_debut_limit' => $date_debut_limit,
                    ':date_fin_limit' => $date_fin_limit,
                    ':poste_id' => $poste_id
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

    function createBooking($request){
        $db = Connection::getPDO();
        $data = null;
        if($db){
            try{
                $query = "INSERT INTO `poste_reserve` SET `utilisateur_id`=:utilisateur_id, `poste_id`=:id, `date_debut`=:date_debut, `date_fin`=:date_fin, `nb_creneaux`=:nb_creneaux";
                $sth = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $sth->execute(array(
                    ':utilisateur_id' => $request["utilisateur_id"],
                    ':id' => $request["id"],
                    ':date_debut' => $request["date_debut"],
                    ':date_fin' => $request["date_fin"],
                    ':nb_creneaux' => $request["nb_creneaux"]
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

