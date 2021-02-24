<h2 class="text-center my-5">Modifier le rendez-vous</h2>

<form class="row g-3" action="" method="post">
   
    <!-- selection du patient -->
    <label for="patient">Patient</label>
    <select name="patient" id="patient">
        <!--profil selectionné-->
        <!-- liste de tout les profils -->
            <?php foreach($listPatient as $patient): ?>
                <option value="<?=$patient->id?>" <?=($patient->id == $selectedAppt->idPatient) ? 'selected': ''?>><?= ucfirst($patient->lastname) . ' ' . ucfirst($patient->firstname) ?></option>
            <?php endforeach?>
    </select>

    <label for="dateAppt">Date du rendez-vous:</label>
    <input type="date" name="dateAppt" id="dateAppt" min="<?=date('Y-m-d')?>" max="<?=date('Y-m-d',strtotime('+6month'))?>" value="<?=date('Y-m-d', strtotime($selectedAppt->dateHour))?>">
    <small>La prise de rendez-vous se fait uniquement sur les 6 prochains mois.</small>

    <label for="timeAppt">Heure du rendez-vous:</label>
    <input type="time" name="timeAppt" id="timeAppt" min="08:30" max="17:30" step="900"  value="<?=date('H:i', strtotime($selectedAppt->dateHour))?>" required>
    <small>Les horaires de consultations sont de 8:30 à 17:30 avec un début toutes les 15 minutes.</small>

    <button type="submit" class="btn btn-primary">Enregistrer le rendez-vous</button>

</form>
