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
        
        // bien penser à mettre les valeur NULL par défaut sinon on ne peut pas instancier la classe sans paramètre
        public function __construct($lastname = NULL ,$firstname = NULL ,$birthdate = NULL ,$phone = NULL ,$mail = NULL ){
            $this->_lastname = $lastname;
            $this->_firstname = $firstname;
            $this->_birthdate = $birthdate;
            $this->_phone = $phone;
            $this->_mail = $mail;
            // connection lors de l'instance de l'objet
            $this->_pdo = Database::connect();
        }
        
        public function addPatient(){
            // $sql = "INSERT INTO `patients` (`lastname`,`firstname`, `birthdate`, `phone`, `mail`) VALUES ('$this->_lastname', '$this->_firstname', '$this->_birthdate', '$this->_phone', '$this->_mail');";

            // on s'assure que la requetes contient bien les valeurs hydratées
            // var_dump($sql);

            // On effectue la requête (/!\ attention le query execute déjà la requête)
            // $sth = $this->_pdo->query($sql);
            // $sth->execute();

            /* Cette méthode ne sécurise pas au niveau de l'injection SQL*/
            // afin de sécurisé on passe par une requête en méthode prepare: 
            try{
                $sql1 = "INSERT INTO `patients` (`lastname`,`firstname`, `birthdate`, `phone`, `mail`) VALUES (:lastname, :firstname, :birthdate, :phone, :mail);";

                $stmt = $this->_pdo->prepare($sql1);
                // on vient lier les valeurs à leur marqueur nominatif (:marker)
                $stmt->bindValue(':lastname', $this->_lastname, PDO::PARAM_STR);
                $stmt->bindValue(':firstname', $this->_firstname, PDO::PARAM_STR);
                $stmt->bindValue(':birthdate', $this->_birthdate, PDO::PARAM_STR);
                $stmt->bindValue(':phone', $this->_phone, PDO::PARAM_STR);
                $stmt->bindValue(':mail', $this->_mail, PDO::PARAM_STR);

                // la methode execute va retourner true ou false si la requêtes c'est bien executé ou non
                return ($stmt->execute());

            } catch(PDOException $e){
                // on pourra gerer plus tard les différentes erreurs
                return false;
                echo 'L\'utilisateur n\'est pas enregistré : ' . $e->getMessage();
            }
        }

        public function listPatient(){
            // récupération de la liste de patient
            try{
                $sql = 'SELECT * FROM `patients`;';  
                $pdo_statement = $this->_pdo->query($sql);

                $listPatients = $pdo_statement -> fetchAll();

                return $listPatients;
            } catch(PDOException $e){
                echo 'erreur de requête : ' . $e->getMessage();
            }
        }

        public function profilPatient($id){
            //récupération du profil sélectionné en GET dans les paramètres de la méthode
            try{
                $sql = "SELECT * FROM `patients` WHERE `id` = :id;";

                $stmt = $this->_pdo->prepare($sql);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $profil = $stmt->fetch();

                return $profil;
            }catch(PDOException $e){
                echo 'erreur de requête : ' . $e->getMessage();
            }
        }

        

    }
    



?>
