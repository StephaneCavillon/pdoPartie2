<?php
    require_once(dirname(__FILE__) . '/../models/Appointments.php');

    $appt = new Appointments();

    //controle des données de choix de page
    /********************************************* */
        if(isset($_GET['idAppt'])){
    
            $idAppt = intval(trim(filter_input(INPUT_GET,'idAppt',FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_NO_ENCODE_QUOTES)));
            
        }

        // if($idAppt<= 0){
        //     header('Location: /controllers/liste-rendezvousCtrl.php');
        // }else{
        // }
        $description = $appt->descriptionAppt($idAppt);
        // var_dump($description);
        if(!$description){
            header('Location: /index.php');
        }
        
    /********************************************** */

    include(dirname(__FILE__) . '/..\views\templates\header.php');

    include(dirname(__FILE__) . '/..\views\rendezvous.php');

    include(dirname(__FILE__) . '/..\views\templates\footer.php');

?>

    