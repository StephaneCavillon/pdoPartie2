<?php

    class Database{
        private static $_pdo;
        
        public static function connect(){

            require_once( dirname(__FILE__) . '/config.php');

            try{
                // On test s'il y a déjà une instance de $_pdo pour ne pas en avoir plusieurs
                if(is_null(self::$_pdo)){
                    self::$_pdo = new PDO(DSN, LOGIN, PASSWORD, [
                            PDO::ATTR_ERRMODE =>  PDO::ERRMODE_EXCEPTION,
                            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                    ]);

                }
            }catch(PDOException $e){
                echo 'Connexion echouée: ' . $e->getMessage();
            }

            // On retourne l'objet afin de pouvoir l'utiliser lors de l'instance des différents objets
            return self::$_pdo;
        }
    }



?>
