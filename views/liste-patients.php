<ul>
    <?php foreach($patients as $patient) : ?>
    <li><a href="mettre l'id pour amener vers le profil"><?= "$patient->lastname $patient->firstname"; ?></a></li>
    <?php endforeach?>
</ul>