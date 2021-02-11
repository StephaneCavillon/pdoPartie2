<?php

    class Database{
        public static function connect(){

            // connexion à la base de donnée

            $dsn = 'mysql:dbname=hospitale2n;host=127.0.0.1;port:3306';
            $login = 'superadmin';
            $password = 'CFxDFCbN930xiUm2';

            try{
                $pdo = new PDO($dsn, $login, $password, [
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
