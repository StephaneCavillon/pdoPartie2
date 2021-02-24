<!--message de validation ou d'erreur-->

<?php

    // affichage d'un message si le patient est bien ajouté à la BDD
    if(isset($testRegister)){
        if($testRegister){
    ?>

        <div class="alert alert-success">Le patient à bien été modifié !</div>

    <?php }else{ ?>

        <div class="alert alert-danger">Le patient n'a pas été modifié !</div>

    <?php
        }
    }
?>



<h2 class="text-center my-5">Modification du profil du patient</h2>

<form class="row g-3" action="" method="post">
    
    <!-- nom prenom  -->
    <div class="input-group mb-3">
        <span class="input-group-text">Prénom et Nom</span>
        <input 
            type="text" 
            name="firstname" 
            id="firstname" 
            aria-label="First name" 
            class="form-control"
            pattern="[A-Za-z-éèêëàâäôöûüç' ]+"  
            value="<?= $profil->firstname ?? '' ?>" 
            required/>
        <input 
            type="text" 
            name="lastname" 
            id="lastname" 
            aria-label="Last name" 
            class="form-control"
            pattern="[A-Za-z-éèêëàâäôöûüç' ]+" 
            value="<?= $profil->lastname ?? ''?>" 
            required/>
        <small><?= $errorsArray['firstname_error'] ?? ''?><?= $errorsArray['lastname_error'] ?? ''?></small>

    </div>

    <!-- birthdate -->
    <div class="input-group mb-3">
        <span class="input-group-text">Date de naissance</span>
        <input 
            type="date" 
            class="form-control" 
            id="birthDate" 
            name="birthDate" 
            value="<?= $profil->birthdate ?? ''?>">
        <small id="birthDate_error" class="form-text"><?= $errorsArray['birthDate_error'] ?? ''?></small>
    </div>

    <!-- Email input -->
    <div class="input-group mb-3">
        <span class="input-group-text">Adresse Mail</span>
        <input 
            type="mail" 
            name="mail" 
            id="mail" 
            aria-label="mail" 
            class="form-control" 
            placeholder="nom@gmail.fr" 
            value="<?= $profil->mail ?? ''?>" 
            required/>
        <small id="mail_error" class="form-text"><?= $errorsArray['mail_error'] ?? ''?></small>

    </div>

    <!-- Telephone Number input -->
    <div class="input-group mb-3">
        <span class="input-group-text">Téléphone</span>
        <input 
            type="text" 
            name="phone" 
            id="phone" 
            aria-label="phone" 
            class="form-control" 
            placeholder="0612345678" 
            value="<?= $profil->phone ?? ''?>" 
            pattern="/([\+0-9]{1,3}[0-9]{8,12})|[0-9]{8,15}$" 
            />
        <small id="phone_error" class="form-text"><?= $errorsArray['phone_error'] ?? ''?></small>
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer le patient</button>

</form>

<?php