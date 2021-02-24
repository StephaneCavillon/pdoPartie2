<h2 class="my-5">Liste des patients</h2>

<table class="table table-striped">
    <form action="" method="GET" >
        <div class="input-group rounded">
            <input type="search" name="search" id="search" class="form-control rounded" placeholder="Recherche" aria-label="Search" aria-describedby="search-addon" value="<?= $search ?? ''?>"/>
            <button type="submit" class="input-group-text border-0" id="search-addon">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
    <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Date de naissance</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($listPatients as $patient) : ?>
        <tr>
            <td><?=ucfirst($patient->lastname)?></td>
            <td><?=ucfirst($patient->firstname)?></td>
            <td><?=date('d/m/Y',strtotime($patient->birthdate))?></td>
            <td><a href="/controllers/profil-patientCtrl.php?id_patient=<?=$patient->id?>"><i class="fas fa-plus"></a></td>
            <td><button type="button" class="btn btn-primary btn-floating" data-mdb-toggle="modal" data-mdb-target="#deleteValidation" data-id="<?=$patient->id?>"><i class="fas fa-trash-alt"></i></button></td>
        </tr>
    <?php endforeach?>
</table>

<!--Pagination-->
<nav aria-label="Page navigation">
  <ul class="pagination">
    <!-- on affiche precedent que si le nombre de page est sup à 1 -->
    <?php if($page>1): ?>
        <li class="page-item"><a class="page-link" href="?page=<?=$page-1?>">Precedente</a></li>
    <?php endif?>
    <!-- faire un forEach par rapport au nombre de pages-->
    <?php for ($i=1; $i<=$nombrePages; $i++):?>
        <li class="page-item"><a class="page-link" href="?page=<?=$i?>"><?=$i?></a></li>
    <?php endfor?>
    <!-- on affiche suivant que si le nombre de page est inférieur au nombre de page max -->
    <?php if($page < $nombrePages):?>
        <li class="page-item"><a class="page-link" href="?page=<?=$page+1?>">Suivante</a></li>
    <?php endif?>
  </ul>
</nav>

<!-- Modal -->
<div class="modal fade" id="deleteValidation" tabindex="-1" aria-labelledby="Confirmation de suppression" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Confirmation de suppression">Suppression du patient</h5>
        <button
          type="button"
          class="btn-close"
          data-mdb-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">Voulez-vous vraiment supprimer le patient et ses rendez-vous ?</div>
      <div class="modal-footer">
        <!-- le href est definit en JS en fonction du bouton sur lequel on appuie-->
        <a href=""><button type="button" class="btn btn-primary">Supprimer</button></a>
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
          Annuler
        </button>
      </div>
    </div>
  </div>
</div>