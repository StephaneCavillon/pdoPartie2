<?php
    require_once(dirname(__FILE__) . '/../models/patient.php');

    //controle des données de choix de page
/********************************************* */
    if(isset($_GET['id_patient'])){
        $patient = new Patient();

        $id_patient = trim(filter_input(INPUT_GET,'id_patient',FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_NO_ENCODE_QUOTES));

        // $profil = $patient->profilPatient($id_patient);
        // var_dump($patient);
        
    }
/********************************************** */


    //controle des données d'update
/********************************************** */
if($_SERVER['REQUEST_METHOD'] == 'POST'){

        require_once(dirname(__FILE__) . '/../utils/regexp.php');

        $errorsArray = array();
        
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

    // ***************************************************************

    if(empty($errorsArray)){
        // création et hydratation d'un nouvel objet avec les données MAJ 
        $patientUpdated = new Patient($lastname,$firstname,$birthDate,$phone,$mail);


        $testRegister = $patientUpdated->updatePatient($id_patient);
        var_dump($patientUpdated);
    

        header('Location: /controllers/profil-patientCtrl.php?id_patient='. $id_patient);
    
    }


}else{


        $profil = $patient->profilPatient($id_patient);
        // var_dump($patient);
        


}


/********************************************** */

include(dirname(__FILE__) . '/..\views\templates\header.php');

include(dirname(__FILE__) . '/..\views\update-profil-patient.php');

include(dirname(__FILE__) . '/..\views\templates\footer.php');
