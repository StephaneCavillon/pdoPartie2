// Fonction d'attribution du href pour suppression du patient
var deleteBtn = document.querySelectorAll('button[data-id]');
console.log(deleteBtn);
var modalDeleteBtn = document.querySelector('.modal-footer a');
console.log(modalDeleteBtn);

deleteBtn.forEach(anchor =>{
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        // je recupère l'id du client à supprimer
        dataID = this.getAttribute('data-id');

        // Je recupère l'attribut déjà en place pour href
        var href = modalDeleteBtn.getAttribute('href')
        // j'attribue au href du bouton supprimer
        modalDeleteBtn.setAttribute('href', href + dataID);
    })
})