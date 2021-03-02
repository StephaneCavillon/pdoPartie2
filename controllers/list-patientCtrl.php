<?php

require_once(dirname(__FILE__) . '/../models/Patient.php');

$search= '';
$limite = 10;
$debut = 0;

// barre de recherche
$search = trim(filter_input(INPUT_GET,'search',FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));

$patient = new Patient();

//détermination du nombre de pages max
$nombreTotalPatients = $patient->nbPatient($search);
// ceil permet d'arrondir à l'entier supérieur
$nombrePages = ceil($nombreTotalPatients/$limite);

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

$listPatients = $patient->listPatient($debut,$limite,$search);


include(dirname(__FILE__) . '/..\views\templates\header.php');

include(dirname(__FILE__) . '/..\views\list-patient.php');

include(dirname(__FILE__) . '/..\views\templates\footer.php');

?>
