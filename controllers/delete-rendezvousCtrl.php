<?php

require_once(dirname(__FILE__) . '/../models/Appointments.php');

$appt = new Appointments();

// controle des données en _GET pour la suppression d'un rdv
if(isset($_GET['idApptDelete']) && $_GET['idApptDelete'] != 0){
    $idApptDlt = intval(trim(filter_input(INPUT_GET,'idApptDelete',FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_NO_ENCODE_QUOTES)));

    $appt->deleteAppt($idApptDlt);

    // $delete = $appt->deleteAppt($idApptDlt);

    header('Location: /controllers/liste-rendezvousCtrl.php');
}else{
    header('Location: /controllers/liste-rendezvousCtrl.php');
}

?>
