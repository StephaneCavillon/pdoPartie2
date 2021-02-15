<div class="card">
  <div class="card-body">
    <h5 class="card-title"><?= strtoupper($profil->lastname) . ' ' .ucfirst($profil->firstname);?></h5>
    <div class="card-text">
        <ul>
            <li>Date de naissance: <?= date('d/m/Y', strtotime($profil->birthdate));?></li>
            <li>Numéro de téléphone: <?= $profil->phone?></li>
            <li>Adresse mail: <?= $profil->mail?></li>
        </ul>
    </div>
    <a href="/controllers/list-patientCtrl.php"><button type="button" class="btn btn-primary">retour à la liste</button></a>
    <a href="/controllers/update-profil-patientCtrl.php?id_patient=<?=$id_patient?>"><button type="button" class="btn btn-primary">modifier le profil</button></a>
  </div>
</div>