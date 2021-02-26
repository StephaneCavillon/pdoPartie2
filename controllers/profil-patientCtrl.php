<?php
    require_once(dirname(__FILE__) . '/../models/Patient.php');
    require_once(dirname(__FILE__) . '/../models/Appointments.php');


    // si j'ai le temps reprendre l'exo avec un algo qui ressemble a ça pour mettre l'affichage du profil et l'update sur la même page
    // Si idpatient && update=true
        // Si form sent
            // Nettoyage formulaire, new class avec hydratation, updatePatient()
        //Sinon
            // new Patient();  $patient->profilPatient($id_patient);
    // Sinon
        // new Patient();  $patient->profilPatient($id_patient); readprofile
    // 

    $patient = new Patient();
    $appt = new Appointments(); 

//controle des données de choix de page
/********************************************* */
    if(isset($_GET['id_patient'])){

        $id_patient = intval(trim(filter_input(INPUT_GET,'id_patient',FILTER_SANITIZE_NUMBER_INT)));

    }

/********************************************** */

// affichage du profil du patient
$profil = $patient->profilPatient($id_patient);

//affichage des rendez-vous
$listAppt = $appt->listApptByPatient($id_patient);

if(!$profil){
    header('Location: /index.php');
}

    include(dirname(__FILE__) . '/..\views\templates\header.php');

    include(dirname(__FILE__) . '/..\views\profil-patient.php');

    include(dirname(__FILE__) . '/..\views\templates\footer.php');
?>