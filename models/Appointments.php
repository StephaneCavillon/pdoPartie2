<?php

    require_once(dirname(__FILE__) . '/../utils/database.php');

    class Appointments{
        private $_dateHour;
        private $_idPatients;
        private $_pdo;

        public function __construct($dateHour = NULL ,$idPatients = NULL){
            $this->_dateHour = $dateHour;
            $this->_idPatients = $idPatients;

            $this->_pdo = Database::connect();
        }

        public function addAppt(){

            try{
                $sql = "INSERT INTO `appointments` (`dateHour`, `idPatients`) VALUES (:dateHour, :idPatients);";

                $stmt = $this->_pdo->prepare($sql);
                $stmt->bindValue(':dateHour', $this->_dateHour,PDO::PARAM_STR);
                $stmt->bindValue(':idPatients', $this->_idPatients, PDO::PARAM_INT);
              
        
                return ($stmt->execute());
            
            }catch(PDOException $e){
            // on pourra gerer plus tard les différentes erreurs
            return false;
            echo 'Le rendez-vous n\'est pas enregistré : ' . $e->getMessage();
            }
        }

        public function listAppt($debut=null, $limite=null, $search=NULL){

            try{
                $sql = 'SELECT `patients`.`lastname`,`patients`.`firstname`, `patients`.`id` as idPatient, `appointments`.`id` as idAppt, `appointments`.`dateHour`
                FROM  `appointments`
                INNER JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id` 
                WHERE `lastname` LIKE  :search OR `firstname` LIKE :search
                ORDER BY `dateHour` LIMIT :limite OFFSET :debut;';
                   
                $stmt = $this->_pdo->prepare($sql);
                $stmt->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
                $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
                $stmt->bindValue(':debut', $debut, PDO::PARAM_INT);

                $stmt->execute();

                $listAppt = $stmt->fetchAll();
                return $listAppt;

            }catch(PDOException $e){
                // on pourra gerer plus tard les différentes erreurs
                echo 'La liste n\est pas disponible: ' . $e->getMessage();
                return false;
            }
        }

        public function nbAppt($search=NULL){
            try{
                $sql = 'SELECT count(`Appointments`.`id`) FROM `Appointments`
                    INNER JOIN `Patients` ON `appointments`.`idPatients` = `patients`.`id`
                    WHERE `lastname` LIKE :search OR `firstname` LIKE :search;';
                $stmt = $this->_pdo->prepare($sql);
                $stmt->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
                $stmt->execute();

                $nombreTotalAppt = $stmt->fetchColumn();

                return $nombreTotalAppt;
            }catch(PDOException $e){
                echo 'erreur de requête : ' . $e->getMessage();
            }

        }


        public function descriptionAppt($idAppt){
            //récupération du profil sélectionné en GET dans les paramètres de la méthode
            try{
                $sql = "SELECT `patients`.`lastname`,`patients`.`firstname`, `patients`.`id` as idPatient, `appointments`.`id` as idAppt, `appointments`.`dateHour`
                FROM  `appointments`
                INNER JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id` WHERE `appointments`.`id` = :id;";

                $stmt = $this->_pdo->prepare($sql);
                $stmt->bindValue(':id', $idAppt, PDO::PARAM_INT);
                $stmt->execute();
                $descriptionAppt = $stmt->fetch();
                // var_dump($descriptionAppt);
                return $descriptionAppt;

            }catch(PDOException $e){
                echo 'erreur de requête : ' . $e->getMessage();
            }
        }
            
        public function updateAppt($idAppt){

            try{
                $sql= " UPDATE `appointments` 
                        SET `dateHour`= :dateHour,
                            `idPatients` = :idPatients 
                        WHERE `id` = :id;";
                
                $stmt = $this->_pdo->prepare($sql);

                $stmt->bindValue(':id',$idAppt, PDO::PARAM_INT);
                $stmt->bindValue(':dateHour', $this->_dateHour, PDO::PARAM_STR);
                $stmt->bindValue(':idPatients', $this->_idPatients, PDO::PARAM_STR);

                return ($stmt->execute());
            }catch(PDOException $e){
                // on pourra gerer plus tard les différentes erreurs
                echo 'Le rendez-vous n\'est pas modifié : ' . $e->getMessage();
                return false;
            }


        }
    
        public function listApptByPatient($idPatient){
            try{
                $sql = 'SELECT * FROM `appointments` WHERE `idPatients` = :id;';  
                $stmt = $this->_pdo->prepare($sql);
                $stmt->bindValue(':id',$idPatient,PDO::PARAM_INT);
                $stmt->execute();
                $listAppt = $stmt -> fetchAll();

                return $listAppt;
            } catch(PDOException $e){
                echo 'erreur de requête : ' . $e->getMessage();
            }

        }

        public function deleteAppt($idAppt){

            try{ 
                $sql= " DELETE FROM `appointments` 
                WHERE `id` = :id;";
        
                $stmt = $this->_pdo->prepare($sql);

                $stmt->bindValue(':id',$idAppt, PDO::PARAM_INT);

                return ($stmt->execute());
            }catch(PDOException $e){
                // on pourra gerer plus tard les différentes erreurs
                echo 'Le rendez-vous n\'est pas supprimé : ' . $e->getMessage();
                return false;
            }


        }

        public function deleteApptFromPatient($idPatient){
            
            try{ 
                $sql= " DELETE FROM `appointments` 
                WHERE `idPatients` = :id;";
        
                $stmt = $this->_pdo->prepare($sql);

                $stmt->bindValue(':id',$idPatient, PDO::PARAM_INT);

                return ($stmt->execute());
            }catch(PDOException $e){
                // on pourra gerer plus tard les différentes erreurs
                echo 'Le rendez-vous n\'est pas supprimé : ' . $e->getMessage();
                return false;
            }

        }

    }
?> 