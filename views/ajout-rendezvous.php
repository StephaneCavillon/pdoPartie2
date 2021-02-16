<h2 class="text-center my-5">Enregistrer un rendez-vous</h2>

<form class="row g-3" action="" method="post">
    <!-- selection du patient -->
    <label for="patient">Selectionner le patient</label>
    <select name="patient" id="patient">
        <?php foreach($patients as $patient): ?>
            <option value="<?=$patient->id?>"><?= $patient->lastname . ' ' . $patient->firstname ?></option>
        <?php endforeach?>
    </select>

    <input type="date" name="dateAppt" id="dateAppt">
    <input type="time" name="timeAppt" id="timeAppt">

    <button type="submit" class="btn btn-primary">Enregistrer le patient</button>

</form>

<?php