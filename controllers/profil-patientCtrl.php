<?php
    require_once(dirname(__FILE__) . '/../models/patient.php');

    $patient = new Patient();

    //controle des données
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $id_patient = trim(filter_input(INPUT_GET,'id_patient',FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_NO_ENCODE_QUOTES));

        $profil = $patient->profilPatient($id_patient);
        // var_dump($profil);
    }

    include(dirname(__FILE__) . '/..\views\templates\header.php');

    include(dirname(__FILE__) . '/..\views\profil-patient.php');

    include(dirname(__FILE__) . '/..\views\templates\footer.php');
?>