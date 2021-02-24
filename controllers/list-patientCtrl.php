<?php

require_once(dirname(__FILE__) . '/../models/Patient.php');

$patient = new Patient();

//pagination
if(!empty($_GET['page'])){
    $page = intval(trim(filter_input(INPUT_GET,'page', FILTER_SANITIZE_NUMBER_INT)));

    // gestion du cas ou l'utilisateur rentre un chiffre ou un nombre négatif
    if($page <= 0){
        $page = 1;
    }

}else {
    $page = 1;
}

$nombrePages = $patient->nbPage();

// barre de recherche
if(!isset($_GET['search'])){
    $listPatients= $patient->listPatient($page);
}else{
    $search = trim(filter_input(INPUT_GET,'search',FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    $listPatients = $patient->searchPatient($search);
}

include(dirname(__FILE__) . '/..\views\templates\header.php');

include(dirname(__FILE__) . '/..\views\list-patient.php');

include(dirname(__FILE__) . '/..\views\templates\footer.php');

?>
