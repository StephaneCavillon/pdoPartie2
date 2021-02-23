<?php

require_once(dirname(__FILE__) . '/../models/Patient.php');

$patient = new Patient();

if(!isset($_GET['search'])){
    $listPatients= $patient->listPatient();
}else{
    $search = trim(filter_input(INPUT_GET,'search',FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    $listPatients = $patient->searchPatient($search);

}

include(dirname(__FILE__) . '/..\views\templates\header.php');

include(dirname(__FILE__) . '/..\views\list-patient.php');

include(dirname(__FILE__) . '/..\views\templates\footer.php');

?>
