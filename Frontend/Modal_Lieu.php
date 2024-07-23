<div class="modal fade" data-bs-backdrop="static" id="updateLieu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Mise à jour d'un lieu</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <form method="POST" class="modalLieuForm">
                        <div class="mb-3">
                            <label for="id2">Id</label> <br>
                            <input type="text" id="id2" name="id2" readonly> <br> <br> 
                            <label for="designation2">Désignation</label> <br>
                            <input type="text" name="designation2" id="designation2"> <br> <br>
                            <label for="province2">Province</label> <br>
                            <input type="text" name="province2" id="province2"> <br> <br>             
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button id='submitUpdate' class="btn btn-primary">Enregistrer</button>
                            </div>
                        </div>  
                    </form>
                </div>
        </div>
    </div>
</div> 


<script>
    $(document).on('click', '#submitUpdate', function(event){
        // Empêcher le formulaire de se soumettre de manière traditionnelle
        event.preventDefault();

        // Collecter les données du formulaire
        var formData = $('.modalLieuForm').serialize();

        // Envoyer les données au script PHP
        $.ajax({
            type: 'POST',
            url: 'Update_Lieu.php',
            data: formData, // Envoyer les données du formulaire
            success: function(response){
                // Afficher une boîte de dialogue de succès
                Swal.fire({
                    title: "Modification réussie!",
                    text: "Ce lieu a été mis à jour",
                    icon: "success"
                }).then(() => {
                    // Recharger la page après l'ajout
                    location.reload();
                });
            }
        });
    });
</script>
