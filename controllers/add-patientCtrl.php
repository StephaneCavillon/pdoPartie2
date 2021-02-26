<?php

    require_once(dirname(__FILE__) . '/../models/Patient.php');

// controle des données
/******************************************************************************************************** */
    /********************************************** */
        include(dirname(__FILE__) . '/../utils/regexp.php');
        
        $errorsArray = array();

        //On ne controle que s'il y a des données envoyées 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

    
            // On verifie l'existance et on nettoie
            $firstname = strtolower(trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)));

            //On test si le champ n'est pas vide
            if(!empty($firstname)){
                // On test la valeur
                $testRegex = preg_match(REGEXP_STR_NO_NUMBER,$firstname);

                if($testRegex == false){
                    $errorsArray['firstname_error'] = 'Le Prénom n\'est pas valide';
                }
            }else{
                $errorsArray['firstname_error'] = 'Le champ n\'est pas rempli';
            }

        // ***************************************************************
            // On verifie l'existance et on nettoie
            $lastname = strtolower(trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)));

            //On test si le champ n'est pas vide
            if(!empty($lastname)){
                // On test la valeur
                $testRegex = preg_match(REGEXP_STR_NO_NUMBER,$lastname);

                if($testRegex == false){
                    $errorsArray['name_error'] = 'Le nom n\'est pas valide';
                }
            }else{
                $errorsArray['name_error'] = 'Le champ n\'est pas rempli';
            }

        // ***************************************************************

            // On verifie l'existance et on nettoie
            $birthDate = trim(filter_input(INPUT_POST, 'birthDate', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));

            //On test si le champ n'est pas vide
            if(!empty($birthDate)){
                // On test la valeur
                $testRegex = preg_match(REGEXP_DATE,$birthDate);

                // On peut aller plus loin sur le test de la date à cet endroit

                if($testRegex == false){
                    $errorsArray['birthDate_error'] = 'Le date n\'est pas valide, le format attendu est JJ/MM/YYYY';
                }
            }else{
                $errorsArray['birthDate_error'] = 'Le champ n\'est pas rempli';
            }

        // ***************************************************************
            
            // On verifie l'existance et on nettoie
            $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));

            //On test si le champ n'est pas vide
            if(!empty($phone)){
                // On test la valeur
                $testRegex = preg_match(REGEXP_PHONE,$phone);

                if($testRegex == false){
                    $errorsArray['phone_error'] = 'Le numero n\'est pas valide, les séparateur sont - . /';
                }
            }
        // ***************************************************************
        
            // On verifie l'existance et on nettoie
            $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));

            //On test si le champ n'est pas vide
            if(!empty($mail)){
                // On test la valeur
                $testMail = filter_var($mail, FILTER_VALIDATE_EMAIL);

                if($testMail == false){
                    $errorsArray['mail_error'] = 'Le mail n\'est pas valide';
                }
            }else{
                $errorsArray['mail_error'] = 'Le champ n\'est pas rempli';
            }

    /* ***************************************************************/

    //création de l'instance de patient
    /******************************************************************************************************** */
        if(empty($errorsArray)){
            $pdo = Database::connect();
            $patient = new Patient($lastname,$firstname,$birthDate,$phone,$mail);
            // On test si le patient à bien été ajouté ou non dans la base de données
            $testRegister = $patient->addPatient($pdo);
            // var_dump($testRegister);
        }

    /******************************************************************************************************** */
    }
/******************************************************************************************************** */




include(dirname(__FILE__) . '/..\views\templates\header.php');

include(dirname(__FILE__) . '/../views/ajout-patient.php');

include(dirname(__FILE__) . '/..\views\templates\footer.php');
?>