<?php 
    include(dirname(__FILE__) . '/../utils/database.php');

    class Patient{
        private $_lastname;
        private $_firstname;
        private $_birthdate;
        private $_phone;
        private $_mail;
        // attribut de connection
        private $_pdo;
    
        public function __construct($lastname,$firstname,$birthdate,$phone,$mail){
            $this->_lastname = $lastname;
            $this->_firstname = $firstname;
            $this->_birthdate = $birthdate;
            $this->_phone = $phone;
            $this->_mail = $mail;
            // connection lors de l'instance de l'objet
            $this->_pdo = Database::connect();
        }
        
        public function addPatient(){
            // $sql = "INSERT INTO `patients` (`lastname`,`firstname`, `birthdate`, `phone`, `mail`) VALUES ('$this->_lastname', '$this->_firstname', '$this->_birthdate', '$this->_phone', '$this->_mail')";

            // on s'assure que la requetes contient bien les valeurs hydratées
            // var_dump($sql);

            // On effectue la requête (/!\ attention le query execute déjà la requête)
            // $sth = $this->_pdo->query($sql);
            // $sth->execute();

            /* Cette méthode ne sécurise pas au niveau de l'injection SQL*/
            // afin de sécurisé on passe par une requête en méthode prepare: 
            try{
                $sql1 = "INSERT INTO `patients` (`lastname`,`firstname`, `birthdate`, `phone`, `mail`) VALUES (:lastname, :firstname, :birthdate, :phone, :mail)";

                $stmt = $this->_pdo->prepare($sql1);
                // on vient lier les valeurs a leur marqueur nominatif (:marker)
                $stmt->bindValue(':lastname', $this->_lastname, PDO::PARAM_STR);
                $stmt->bindValue(':firstname', $this->_firstname, PDO::PARAM_STR);
                $stmt->bindValue(':birthdate', $this->_birthdate, PDO::PARAM_STR);
                $stmt->bindValue(':phone', $this->_phone, PDO::PARAM_STR);
                $stmt->bindValue(':mail', $this->_mail, PDO::PARAM_STR);

                // la methode execute va retourner true ou false si la requêtes c'est bien executé ou non
                return ($stmt->execute());
            } catch(PDOException $e){
                // on pourra gerer plus tard les différentes erreurs
                // return false;
                echo 'L\'utilisateur n\'est pas enregistré : ' . $e->getMessage();
            }
        }

        public function listPatient(){
            //récupération de la liste de patient
            try{        
                $pdo_statement = $this->_pdo->query('SELECT * FROM `patients`');

                $listPatients = $pdo_statement -> fetchAll();
            } catch(PDOException $e){
                echo 'erreur de requête : ' . $e->getMessage();
            }

        }

    }
    



?>
