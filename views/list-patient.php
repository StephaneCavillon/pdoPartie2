<h2 class="my-5">Liste des patients</h2>


<ul>
    <?php foreach($listPatients as $patient) : ?>
    <li><a href="?id=<?=$patient->id?>"><?= "$patient->lastname $patient->firstname"; ?></a></li>
    <?php endforeach?>
</ul>