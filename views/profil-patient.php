<div class="container-fluid my-5">
  <div class="row">
    <div class="col">
      <!--profil du patient-->
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
    </div>
    <div class="col">
      <!-- liste des rdv du patient -->
      <h4 class="text-center mt-5">Liste des rendez-vous de ce patient:</h4>
      <table class="table table-hover">
        <thead>
            <tr>
              <th scope="col">Date</th>
              <th scope="col">Heure</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($listAppt as $Appt):?>
            <tr>
              <td><?=date('d-m-Y', strtotime($Appt->dateHour))?></td>
              <td><?=date('H:i', strtotime($Appt->dateHour))?></td>
              <td><a href="/controllers/rendezvousCtrl.php?idAppt=<?=$Appt->id?>"><i class="fas fa-plus"></i></a></td>
            </tr>
            <?php endforeach?>
          </tbody>

      </table>
    </div>
  </div>
</div>