<h2 class="my-5">Liste des patients</h2>


<ul>
    <?php foreach($listPatients as $patient) : ?>
    <li><a href="/controllers/profil-patientCtrl.php?id_patient=<?= $patient->id?>"><?= ucfirst($patient->lastname). ' ' . ucfirst($patient->firstname); ?></a></li>
    <?php endforeach?>
</ul>