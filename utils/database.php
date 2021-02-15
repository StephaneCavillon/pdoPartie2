<?php

    class Database{
        public static function connect(){

            require_once( dirname(__FILE__) . '/config.php');

            try{
                $pdo = new PDO(DSN, LOGIN, PASSWORD, [
                        PDO::ATTR_ERRMODE =>  PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ]);
            }catch(PDOException $e){
                echo 'Connexion echouée: ' . $e->getMessage();
            }

            // On retourne l'objet afin de pouvoir l'utiliser lors de l'instance des différents objets
            return $pdo;
        }
    }



?>
