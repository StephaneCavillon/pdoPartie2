// Fonction d'attribution du href pour suppression du patient
var deleteBtn = document.querySelectorAll('button[data-id]');
var modalDeleteBtn = document.querySelector('.modal-footer a');

deleteBtn.forEach(btn =>{
    btn.addEventListener('click', function (e) {
        e.preventDefault();

        // je recupère l'id du client à supprimer
        dataID = this.getAttribute('data-id');

        // Je recupère l'attribut déjà en place pour href
        var href = modalDeleteBtn.getAttribute('href')
        // j'attribue au href du bouton supprimer
        modalDeleteBtn.setAttribute('href', href + dataID);
    })
})

let i=1;
listPatients=[];

// test AJAX et fetch n'est pas completement fonctionnel
//création du listener au scroll sur windows
window.addEventListener('scroll', function(){

    let height = window.innerHeight;
    console.log(scrollY);
    const {
        scrollTop,
        scrollHeight,
        clientHeight
    } = document.documentElement;
    console.log(scrollTop,scrollHeight,clientHeight);

    // if(scrollY > (height - 600)){
    if(scrollTop + clientHeight >= scrollHeight-400){
        // permet de n'avoir qu'un seul déclenchement de l'event
        // scrollY = 0;
        i++;
        fetch('/controllers/list-patientCtrl.php?page='+i+'&ajax=1')
        .then(function(reponse){
            return reponse.json();
        })
        .then(function(datas){
            display(datas);
            // console.log(datas)
            return datas;            
        })
        .catch(console.error)
    
    }
})

var patientTable = document.querySelector('tbody');
console.log(patientTable);

// fonction pour afficher la suite des patients
function display(data) {
    // console.log(data);

    for (let objet in data){
        patientTable.innerHTML += 
            '<tr><td>'+data[objet].lastname+'</td><td>'+data[objet].firstname+'</td><td>'+data[objet].birthdate+'</td><td><a href="/controllers/profil-patientCtrl.php?id_patient='+data[objet].id+'"><i class="fas fa-plus"></a></td><td><button type="button" class="btn btn-primary btn-floating" data-mdb-toggle="modal" data-mdb-target="#deleteValidation" data-id="'+data[objet].id+'"><i class="fas fa-trash-alt"></i></button></td></tr>'; 
    }
   
}

