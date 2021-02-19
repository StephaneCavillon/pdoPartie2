<h2 class="my-5">Liste des rendez-vous</h2>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Date du rendez-vous</th>
            <th scope="col">Heure du rendez-vous</th>
            <th scope="col">Patient rencontré</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($listAppt as $appt) : ?>
            <tr scope="row">
                <td><?=date('d-m-Y', strtotime($appt->dateHour))?></td>
                <td><?=date('H:i', strtotime($appt->dateHour))?></td>
                <td><?=$appt->lastname . ' ' . $appt->firstname?></td>
                <td><a href="/controllers/rendezvousCtrl.php?idAppt=<?=$appt->idAppt?>"><i class="fas fa-plus"></i></a></td>
            </tr>
        <?php endforeach?> 
    </tbody>
</table>