<?php 
require 'connection.php';
require 'SideBar.php';
require 'Modal_Lieu.php';
?>
<div class="header">
    <div class="text-center">
        <h1>Lieu</h1>
    </div>

    <div class="rechercher">
            <input type="text" placeholder="Rechercher un lieu..." id="recherche" class="recherches">
            <i class="lni lni-search-alt" id="search"></i> 
    </div>
</div>

<div class="contenu">
    <div class="interieur">
        <form  method="POST" class="lieuForm">
            <h2 class='title'>Ajouter un nouveau lieu</h2> 
            <?php
                $sql = "SELECT SUBSTRING(idlieu, 2) AS last_id FROM lieu ORDER BY CAST(SUBSTRING(idlieu, 2) AS UNSIGNED) DESC LIMIT 1";
                $result = $connect->query($sql);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $i = $row['last_id'] + 1;
                }else{
                    $i = 1;
                }
            
                echo '<label for="id">Id: </label>';
                echo '<input type="text" name="id" id="id" value="L'. $i . '" readonly> <br> <br>';
            ?>
            <label for="designation">Désignation: </label> <br>
            <input type="text" name="designation" id="designation"> <br> <br>
            <label for="province">Province: </label> <br>
            <input type="text" name="province" id="province"> <br> <br>
            <div class="bouton">
                <button id='submit' disabled>Ajouter</button>
            </div>
        </form>
        <div class="lieuTable">
            <table id="lieuTable" class="display">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Désignation</th>
                        <th>Province</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = 'SELECT * FROM lieu ORDER BY CAST(SUBSTRING(idlieu, 2) AS UNSIGNED) ASC';
                        $result = $connect->query($sql);
                        if($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()){
                                echo "<tr>";
                                echo "<td>" . $row["idlieu"] . "</td>";
                                echo "<td>" . $row["design"] . "</td>";
                                echo "<td>" . $row["province"] . "</td>";
                                echo '<td id="' . $row['idlieu'] . '">
                                    <div class="action">
                                        <div class="edit" id="editer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="editor" viewBox="0 0 16 16">
                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                            </svg>
                                        </div>
                                        <div class="trash" id="supprimer">
                                            <i class="lni lni-trash-can" id="trash"></i>
                                        </div>
                                    </div>
                                    </td>';
                                echo "</tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
   
<?php require 'Footer.php';?>

<script>
    //--------------------------Vérifier si les données en entrée n'est pas vide---------------------------//
    function checkInputsLieu() {
        const designation = document.getElementById("designation").value.trim();
        const province = document.getElementById("province").value.trim();
        const submitButton = document.getElementById("submit");
        
        const isValid = designation !== '' && province !== '';
        
        if (isValid) {
            submitButton.removeAttribute('disabled');
        } else {
            submitButton.setAttribute('disabled', 'true');
        }
    }
    
    document.getElementById("designation").addEventListener('input', checkInputsLieu);
    document.getElementById("province").addEventListener('input', checkInputsLieu);

    //-----------------------------------------Ajout d'un lieu--------------------------------------------//
    $(document).on('click', '#submit', function(event){
        // Empêcher le formulaire de se soumettre de manière traditionnelle
        event.preventDefault();

        // Collecter les données du formulaire
        var formData = $('.lieuForm').serialize();

        // Envoyer les données au script PHP
        $.ajax({
            type: 'POST',
            url: 'Create_Lieu.php',
            data: formData, // Envoyer les données du formulaire
            dataType: 'json',
            success: function(response){
                if (response.success) {
                    // Afficher une boîte de dialogue de succès
                    Swal.fire({
                        title: "Ajouter!",
                        text: response.message,
                        icon: "success"
                    }).then(() => {
                        // Recharger la page après l'ajout
                        location.reload();
                    });
                } else {
                        // Afficher une boîte de dialogue d'erreur
                        Swal.fire({
                            title: "Erreur!",
                            text: response.message,
                            icon: "error"
                        });
                    }
            }
        });
    });


    //-----------------------Apparition de la fenêtre modale pour la mise à jour--------------------------//
    // Récupérer les données du lieu à mettre à jour
    $(document).on('click', '#editer', function() {
        // Récupérer l'identifiant du lieu à partir de l'icône d'édition
        var idlieu = $(this).closest('td').attr('id');
        console.log(idlieu); 
            
        // Effectuer une requête AJAX pour récupérer les données du lieu
        $.ajax({
            type: 'POST',
            url: 'lieuData.php', // URL du script PHP pour récupérer les données du lieu
            data: {idlieu: idlieu},
            dataType: 'json',
            success: function(response) {
                // Remplir les champs du formulaire avec les données du lieu
                console.log(response);
                $('#id2').val(response.idlieu);
                $('#designation2').val(response.design);
                $('#province2').val(response.province);

                // Afficher la fenêtre modale de mise à jour
                $('#updateLieu').modal('show');
                },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // Afficher un message d'erreur en cas d'échec de la requête AJAX
                alert('Une erreur s\'est produite lors de la récupération des données du lieu.');
            }
        });
    });

    $(document).on('input', '.recherches', function() {
            var recherche = $(this).val();
            $.ajax({
                type: 'POST',
                url: 'Recherche_Lieu.php',
                data: { recherche: recherche },
                success: function(data) {
                    $('#lieuTable tbody').html(data); // Mettre à jour le contenu du corps de la table
                }
            });
        });

</script>

