<div class="card my-5">
  <div class="card-body">
    <h5 class="card-title">Description du rendez-vous : </h5>
    <div class="card-text">
        <ul>
            <li>Date: <?= date('d/m/Y', strtotime($description->dateHour));?></li>
            <li>Heure: <?= date('H:i', strtotime($description->dateHour));?></li>
            <li>Nom du Patient: <?= ucfirst($description->lastname) .' '. ucfirst($description->firstname)?></li>
        </ul>
    </div>
    <a href="/controllers/liste-rendezvousCtrl.php"><button type="button" class="btn btn-primary">retour à la liste</button></a>
    <a href="/controllers/update-rendezvousCtrl.php?idAppt=<?=$idAppt?>"><button type="button" class="btn btn-primary">modifier le profil</button></a>
  </div>
</div>