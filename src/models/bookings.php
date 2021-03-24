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

