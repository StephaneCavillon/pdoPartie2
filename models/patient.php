<?php 
    require_once(dirname(__FILE__) . '/../utils/database.php');

    class Patient{
        private $_lastname;
        private $_firstname;
        private $_birthdate;
        private $_phone;
        private $_mail;
        // attribut de connection
        private $_pdo;
        
        // bien penser à mettre les valeur NULL par défaut sinon on ne peut pas instancier la classe sans paramètre
        public function __construct($lastname = NULL ,$firstname = NULL ,$birthdate = NULL ,$phone = NULL ,$mail = NULL){
            $this->_lastname = $lastname;
            $this->_firstname = $firstname;
            $this->_birthdate = $birthdate;
            $this->_phone = $phone;
            $this->_mail = $mail;
            // connection lors de l'instance de l'objet
            $this->_pdo = Database::connect();
        }
        
        public function isExist($mail){
            // recherche du profil mis en paramètre
            try{
                $sql = "SELECT `id` FROM `patients` WHERE `mail` = :mail;";
                
                $stmt = $this->_pdo->prepare($sql);
                $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
                $stmt->execute();
                // On ressort le nombre de ligne de resultat
                $exist = $stmt->rowCount();
                
                // on test s'il y a une ligne ou plusieurs
                if($exist >= 1){
                    return true;
                }else{ 
                    return false;
                }

            }catch(PDOException $e){
                echo 'erreur de requête : ' . $e->getMessage();
                return false;
            }
        }

        public function addPatient(){
            // On verifie que le mail n'existe pas déjà
            if(!$this->isExist($this->_mail)){
                // $sql = "INSERT INTO `patients` (`lastname`,`firstname`, `birthdate`, `phone`, `mail`) VALUES ('$this->_lastname', '$this->_firstname', '$this->_birthdate', '$this->_phone', '$this->_mail');";

                // on s'assure que la requetes contient bien les valeurs hydratées
                // var_dump($sql);

                // On effectue la requête (/!\ attention le query execute déjà la requête)
                // $sth = $this->_pdo->query($sql);
                // $sth->execute();

                /* Cette méthode ne sécurise pas au niveau de l'injection SQL*/
                // afin de sécurisé on passe par une requête en méthode prepare: 
                try{
                    $pdo = database::connect();

                    $sql1 = "INSERT INTO `patients` (`lastname`,`firstname`, `birthdate`, `phone`, `mail`) VALUES (:lastname, :firstname, :birthdate, :phone, :mail);";

                    $stmt = $pdo->prepare($sql1);
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
            }else{
                return false;

            }
        }

        public function listPatient($debut=null, $limite=null, $search=NULL){
            // récupération de la liste de patient
            try{  
                if(is_null($search)){
                    if($debut !== null){ 
                        // Requete pour recuperer l'affichage du nombre limite de patient
                        $sql = 'SELECT * FROM `patients` ORDER BY `lastname` LIMIT :limite OFFSET :debut;';  
                        $stmt = $this->_pdo->prepare($sql);
                        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
                        $stmt->bindValue(':debut', $debut, PDO::PARAM_INT);
                    }else{
                        $sql = 'SELECT * FROM `patients` ORDER BY `lastname`;';
                        $stmt = $this->_pdo->query($sql);             
                    }
                }else{
                    $sql= " SELECT * FROM `patients` WHERE `lastname` LIKE  :search OR `firstname` LIKE :search ORDER BY `lastname` LIMIT :limite OFFSET :debut;";
            
                    $stmt = $this->_pdo->prepare($sql);
    
                    $stmt->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
                    $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
                    $stmt->bindValue(':debut', $debut, PDO::PARAM_INT);
    
                }
                $stmt->execute();

                $listPatients = $stmt -> fetchAll();

                return $listPatients;

            } catch(PDOException $e){
                echo 'erreur de requête : ' . $e->getMessage();
            }
        }

        public function nbPatient($search=NULL){
            try{
                // la query ne renvoit qu'un objet avec la requete il faut faire un fetch derriere
                // le fetch simple renvoi un objet, pour simplifier le resultat on utilise le fetchColumn qui renvoit juste un string avec le nombre compté.
                $sql = 'SELECT count(`id`) FROM `patients` WHERE `lastname` LIKE :search OR `firstname` LIKE :search;';
                $stmt = $this->_pdo->prepare($sql);
                $stmt->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
                $stmt->execute();

                $nombreTotalPatients = $stmt->fetchColumn();

                return $nombreTotalPatients;
            }catch(PDOException $e){
                echo 'erreur de requête : ' . $e->getMessage();
            }

        }

        public static function profilPatient($id){
            //récupération du profil sélectionné en GET dans les paramètres de la méthode
            try{
                $pdo = DATABASE::connect();

                $sql = "SELECT * FROM `patients` WHERE `id` = :id;";

                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $profil = $stmt->fetch();

                return $profil;

            }catch(PDOException $e){
                echo 'erreur de requête : ' . $e->getMessage();
            }
        }

        // ne pas mettre tout les paramètres dans la méthode mais utiliser l'hydratation de l'objet faite précedemment
        public function updatePatient($id){

            try{
                $sql= " UPDATE `patients` 
                        SET `lastname`= :lastname,
                            `firstname` = :firstname, 
                            `birthdate` = :birthdate, 
                            `phone` = :phone, 
                            `mail` = :mail
                        WHERE `id` = :id;";
                
                $stmt = $this->_pdo->prepare($sql);

                $stmt->bindValue(':id',$id, PDO::PARAM_INT);
                $stmt->bindValue(':lastname', $this->_lastname, PDO::PARAM_STR);
                $stmt->bindValue(':firstname', $this->_firstname, PDO::PARAM_STR);
                $stmt->bindValue(':birthdate', $this->_birthdate, PDO::PARAM_STR);
                $stmt->bindValue(':phone', $this->_phone, PDO::PARAM_STR);
                $stmt->bindValue(':mail', $this->_mail, PDO::PARAM_STR);

                return ($stmt->execute());
            }catch(PDOException $e){
                // on pourra gerer plus tard les différentes erreurs
                echo 'L\'utilisateur n\'est pas enregistré : ' . $e->getMessage();
                return false;
            }

        }

        public function deletePatient($idPatient){

            try{ 
                $sql= " DELETE FROM `patients` 
                WHERE `id` = :id;";
        
                $stmt = $this->_pdo->prepare($sql);

                $stmt->bindValue(':id',$idPatient, PDO::PARAM_INT);

                return ($stmt->execute());
            }catch(PDOException $e){
                // on pourra gerer plus tard les différentes erreurs
                echo 'Le patient n\'est pas supprimé : ' . $e->getMessage();
                return false;
            }
        }
    }
?>
