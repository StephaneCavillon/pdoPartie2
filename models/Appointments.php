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

        public function listAppt(){

            try{
                $sql = 'SELECT * FROM `appointments` INNER JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id` ORDER BY `dateHour`;';

                $stmt = $this->_pdo->query($sql);
                $listAppt = $stmt->fetchAll();
                return $listAppt;

            }catch(PDOException $e){
                // on pourra gerer plus tard les différentes erreurs
                echo 'La liste n\est pas disponible: ' . $e->getMessage();
                return false;
            }
        }
    }
?>