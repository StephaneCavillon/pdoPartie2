<?php

require_once(dirname(__FILE__) . '/../models/Appointments.php');

$search ='';
$limite = 5;
$debut = 0;

// barre de recherche
$search = trim(filter_input(INPUT_GET,'search',FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));

$appt = new Appointments();


//détermination du nombre de pages max
$nombreTotalAppts = $appt->nbAppt($search);
// ceil permet d'arrondir à l'entier supérieur
$nombrePages = ceil($nombreTotalAppts/$limite);

//pagination
if(!empty($_GET['page'])){

    $page = intval(trim(filter_input(INPUT_GET,'page', FILTER_SANITIZE_NUMBER_INT)));

    // gestion du cas ou l'utilisateur rentre un chiffre ou un nombre négatif
    if($page > 0 && $page <= $nombrePages){
        // calcul pour la pagination
        $debut = ($page-1)*$limite;
    }else{
        $page = 1;
    }    

}else{
    $page = 1;
}


//affichage des rendez-vous
$listAppt= $appt->listAppt($debut,$limite,$search);

// controle des données en _GET pour la suppression d'un rdv
if(isset($_GET['idApptDelete'])){
    $idApptDlt = intval(trim(filter_input(INPUT_GET,'idApptDelete',FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_NO_ENCODE_QUOTES)));

    
}

include(dirname(__FILE__) . '/..\views\templates\header.php');

include(dirname(__FILE__) . '/..\views\liste-rendezvous.php');

include(dirname(__FILE__) . '/..\views\templates\footer.php');

?>
