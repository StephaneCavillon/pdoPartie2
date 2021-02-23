<?php

require_once(dirname(__FILE__) . '/../models/Appointments.php');
require_once(dirname(__FILE__) . '/../models/Patient.php');

$appt = new Appointments();
$patient = new Patient();

// controle des données en _GET pour la suppression
if(isset($_GET['idPatientDelete']) && $_GET['idPatientDelete'] != 0){
    $idPatientDlt = intval(trim(filter_input(INPUT_GET,'idPatientDelete',FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_NO_ENCODE_QUOTES)));

    $appt->deleteApptFromPatient($idPatientDlt);

    
    $patient->deletePatient($idPatientDlt);

    // possibilité de paramètrer dans PHPMyAdmin les contraintes de suppression en cascade sur les clés étrangères

    header('Location: /controllers/list-patientCtrl.php');
}else{
    header('Location: /controllers/list-patientCtrl.php');
}

?>