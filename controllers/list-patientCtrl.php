<?php

require_once(dirname(__FILE__) . '/../models/patient.php');

$patient = new Patient();

$listPatients= $patient->listPatient();

include(dirname(__FILE__) . '/..\views\templates\header.php');

include(dirname(__FILE__) . '/..\views\list-patient.php');

include(dirname(__FILE__) . '/..\views\templates\footer.php');

?>
