<!--message de validation ou d'erreur-->

<?php

    // affichage d'un message si le patient est bien ajouté à la BDD
    if(isset($testRegister)){
        if($testRegister){
    ?>

        <div class="alert alert-success">Le rendez-vous à bien été ajouté !</div>

    <?php }else{ ?>

        <div class="alert alert-danger">Le rendez-vous n'a pas été enregistré</div>

    <?php
        }
    }
?>


<h2 class="text-center my-5">Enregistrer un rendez-vous</h2>

<form class="row g-3" action="" method="post">
    <!-- selection du patient -->
    <label for="patient">Selectionner le patient</label>
    <select name="patient" id="patient">
        <option value=""></option>
        <?php foreach($listPatients as $patient): ?>
            <option value="<?=$patient->id?>"><?= ucfirst($patient->lastname) . ' ' . ucfirst($patient->firstname) ?></option>
        <?php endforeach?>
    </select>

    <label for="dateAppt">Selectionner le jour du rendez-vous:</label>
    <input type="date" name="dateAppt" id="dateAppt" min="<?=date('Y-m-d')?>" max="<?=date('Y-m-d',strtotime('+6month'))?>" value="<?=date('Y-m-d')?>">
    <small>La prise de rendez-vous se fait uniquement sur les 6 prochains mois.</small>


    <label for="timeAppt">Selectionner l'heure du rendez-vous:</label>
    <input type="time" name="timeAppt" id="timeAppt" min="08:30" max="17:30" step="900" required>
    <small>Les horaires de consultations sont de 8:30 à 17:30 avec un début toutes les 15 minutes</small>

    <button type="submit" class="btn btn-primary">Enregistrer le rendez-vous</button>

</form>

