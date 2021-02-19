<?php
    require_once(dirname(__FILE__) . '/../models/Appointments.php');
    require_once(dirname(__FILE__) . '/../models/Patient.php');

    //controle des données de choix de page
/********************************************* */
    if(isset($_GET['idAppt'])){
        $appt = new Appointments();

        $idAppt = intval(trim(filter_input(INPUT_GET,'idAppt',FILTER_SANITIZE_NUMBER_INT)));
    }
/********************************************** */

    // Controle des données de formulaire
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        /******************************************* */
            $idPatient = filter_input(INPUT_POST,'patient',FILTER_SANITIZE_NUMBER_INT);

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

            $testRegister = $appointment->updateAppt($idAppt);

            header('Location: /controllers/rendezvousCtrl.php?idAppt='.$idAppt);
        }
    }else{
        // pour l'affichage des champs du rendez-vous selectionné
        $selectedAppt = $appt->descriptionAppt($idAppt);

        // pour la liste des patients
        $patients = new Patient();
        $listPatient = $patients->listPatient();
}

    include(dirname(__FILE__) . '/..\views\templates\header.php');

    include(dirname(__FILE__) . '/../views/update-rendezvous.php');

    include(dirname(__FILE__) . '/..\views\templates\footer.php');

?>
