<?php

require_once(dirname(__FILE__) . '/../models/Appointments.php');

$appt = new Appointments();

//affichage des rendez-vous
$listAppt= $appt->listAppt();

// controle des données en _GET pour la suppression d'un rdv
if(isset($_GET['idApptDelete'])){
    $idApptDlt = intval(trim(filter_input(INPUT_GET,'idApptDelete',FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_NO_ENCODE_QUOTES)));

    
}

include(dirname(__FILE__) . '/..\views\templates\header.php');

include(dirname(__FILE__) . '/..\views\liste-rendezvous.php');

include(dirname(__FILE__) . '/..\views\templates\footer.php');

?>
