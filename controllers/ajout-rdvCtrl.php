<?php
    require_once(dirname(__FILE__) . '/../models/patient.php');
    require_once(dirname(__FILE__) . '/../models/Appointments.php');

    // $patients qui peut venir de patients list
    $patient = new Patient();

    $listPatients= $patient->listPatient();

    // Controle des données de formulaire
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        /******************************************* */
            $idPatient = filter_input(INPUT_POST,'patient',FILTER_SANITIZE_NUMBER_INT);
            var_dump($idPatient);

            if($idPatient == false || empty($idPatient)){
                $errorMessage = 'Veuillez selectionner un patient.';
            }

        /******************************************* */
            $date = filter_input(INPUT_POST,'dateAppt',FILTER_SANITIZE_STRING);

            if($date < date('Y-m-d')){
                $errorMessage = 'Veuillez choisir une date correct.';
            }
        /******************************************* */
        
            $hour = filter_input(INPUT_POST,'timeAppt',FILTER_SANITIZE_STRING);

            if($hour < date('H:i', strtotime('08:30')) || $hour > date('H:i', strtotime('17:30'))){
                $errorMessage = 'L\'heure selectionné ne correspond pas aux heures d\'ouverture';
            }
        /******************************************* */
        
        if(empty($errorMessage)){
            $dateHour = "$date $hour";
            $appointment = new Appointments($dateHour, $idPatient);
            var_dump($appointment);

            $testRegsister = $appointment->addAppt();

        }
    }

    include(dirname(__FILE__) . '/..\views\templates\header.php');

    include(dirname(__FILE__) . '/../views/ajout-rendezvous.php');

    include(dirname(__FILE__) . '/..\views\templates\footer.php');

?>
