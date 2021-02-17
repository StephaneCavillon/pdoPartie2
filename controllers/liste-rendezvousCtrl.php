<?php

require_once(dirname(__FILE__) . '/../models/Appointments.php');

$appt = new Appointments();

$listAppt= $appt->listAppt();

include(dirname(__FILE__) . '/..\views\templates\header.php');

include(dirname(__FILE__) . '/..\views\liste-rendezvous.php');

include(dirname(__FILE__) . '/..\views\templates\footer.php');

?>
