<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"/>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>

    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.2.0/mdb.min.css" rel="stylesheet"/>

    <title>exercice 2 - Ecrire les données</title>
</head>
    <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/index.php">Hopitale2n</a>
            <!-- bouton hamburger -->
            <button
            class="navbar-toggler"
            type="button"
            data-mdb-toggle="collapse"
            data-mdb-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
            >
            <i class="fas fa-bars"></i>
            </button>
            <!-- menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <!-- patient dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            Patients
                        </a>
                        <!-- Dropdown menu -->
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/controllers/add-patientCtrl.php">ajouter un patient</a></li>
                            <li><a class="dropdown-item" href="/controllers/list-patientCtrl.php?page=1">liste des patients</a></li>
                        </ul>
                    </li>
                <!-- rendez-vous dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            Rendez-vous
                        </a>
                        <!-- Dropdown menu -->
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/controllers/ajout-rdvCtrl.php">Ajout d'un rendez-vous</a></li>
                            <li><a class="dropdown-item" href="/controllers/liste-rendezvousCtrl.php">Liste des rendez-vous</a></li>
                        </ul>
                    </li>
                <!-- ajout patient et rendez-vous-->
                    <li class="nav-item">
                        <a class="nav-link" href="/controllers/ajout-patient-rdvCtrl.php">Enregistrer un patient et son rendez-vous</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
  