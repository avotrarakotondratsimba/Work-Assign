<?php require 'connection.php';?>
<?php require 'SideBar.php';?>
<div class="text-center" id='historicTitle'>
    <h1>Historique</h1>

    <div class="rechercher" id='historicSearch'>
            <input type="text" placeholder="Rechercher un employé..." id="recherche" class="rechercheHisto">
            <i class="lni lni-search-alt" id="search"></i> 
    </div>
</div>

    <div class="historic">
        <div id='dateSetting'>
            <form id='historicForm'>
                <div class="debut">
                    <label for="debut">Début</label> <br>
                    <input class="form-control 2" name='debut' id='debut' type="date" aria-label="default input example">
                </div>
                <div class="fin">
                    <label for="fin">Fin</label> <br>
                    <input class="form-control 2" name='fin' id='fin' type="date" aria-label="default input example">
                </div>
                <div class="soumisions">
                    <br>
                    <button type="button" id='generer' class="btn btn-dark">Générer</button>
                </div>
                <div class="reload">
                    <br> 
                    <i class="lni lni-reload"></i>
                </div>
            </form>
        </div>

        <table id="historicTable" >
            <thead>
                <tr>
                    <th>N° d'affectation</th>
                    <th>N° d'employé</th>
                    <th>Nom</th>
                    <th>Prénom(s)</th>
                    <th>Ancien lieu</th>
                    <th>Nouveau lieu</th>
                    <th>Date d'affectation</th>
                    <th>Date de prise de service</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
                // Requête SQL pour sélectionner tous les affectations
                $sql = "SELECT a.*, e.nom, e.prenom FROM affectation a JOIN employe e on a.numemp = e.numemp
                        ORDER BY numAffect ASC";
                $result = $connect->query($sql);

                // Vérifie s'il y a des résultats
                if ($result->num_rows > 0) {
                    // Affiche les données dans le tableau
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["numAffect"] . "</td>";
                        echo "<td>" . $row["numEmp"] . "</td>";
                        echo "<td>" . $row["nom"] . "</td>";
                        echo "<td>" . $row["prenom"] . "</td>";
                        echo "<td>" . $row["ancienLieu"] . "</td>";
                        echo "<td>" . $row["nouveauLieu"] . "</td>";
                        echo "<td>" . $row["dateAffect"] . "</td>";
                        echo "<td>" . $row["datePriseService"] . "</td>";
                        echo '<td  id="'. $row["numAffect"] . '">
                            <div class="action">
                                <div class="edit" id="edition">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="editor" viewBox="0 0 16 16">
                                        <path id="edit" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                    </svg>
                                </div>
                                <div class="trash" id="suppressionHisto">
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
    
    <script>
        

        //------------------------------------Recherche d'employé-----------------------------------------\\
        $(document).ready(function(){
            $('.rechercheHisto').on('input', function() {
                var recherche = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: 'Recherche_Employe_Histo.php',
                    data: { recherche: recherche },
                    success: function(data) {
                        $('#historicTable tbody').html(data); // Mettre à jour le contenu du corps de la table
                    }
                });
            });
        });

        //------------------------------------Suppression d'une historique---------------------------------\\
        $(document).on('click', '#suppressionHisto', function(){
            var numAffect = $(this).closest('td').attr('id'); // Récupérer l'identifiant de l'employé à supprimer
            Swal.fire({
                title: "Êtes-vous sûr(e)?",
                text: "Vous ne pourrez pas revenir en arrière!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Oui, supprimez-le!",
                cancelButtonText: "Annuler"
            }).then((result) => {
                if (result.isConfirmed) {
                // Effectuer une requête AJAX pour supprimer l'historique de l'employé de la base de données
                $.ajax({
                    type: 'POST',
                    url: 'Delete_Histo.php',
                    data: { numAffect: numAffect },
                    success: function(response) {
                        // Afficher une boîte de dialogue de succès
                        Swal.fire({
                            title: "Supprimer!",
                            text: "Cet historique a été supprimé",
                            icon: "success"
                        }).then(() => {
                            // Recharger la page après la suppression
                            location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Afficher une boîte de dialogue d'erreur
                        Swal.fire({
                            title: "Error!",
                            text: "An error occurred while deleting the employee.",
                            icon: "error"
                        });
                    }
                });
                }
            });
        });


    //------------------------------------Historique entre deux dates---------------------------------\\
    $(document).ready(function(){
            $('#generer').on('click', function() {
                // Empêcher le formulaire de se soumettre de manière traditionnelle
                event.preventDefault();

                // Collecter les données du formulaire
                var formData = $('#historicForm').serialize();
                

                // Envoyer les données au script PHP
                $.ajax({
                    type: 'POST',
                    url: 'intervaleDate.php',
                    data: formData, // Envoyer les données du formulaire
                    success: function(data) {
                        $('#historicTable tbody').html(data); // Mettre à jour le contenu du corps de la table
                    },
                });
            });
        });

    //------------------------------Réglage de la deuxième champ de date------------------------------\\
    // Récupération des éléments input
   
    
    const finInput = document.getElementById('fin');

    // Écouteur d'événement sur le changement de valeur dans le premier champ de date
    debutInput.addEventListener('change', function() {
        // Met à jour la propriété 'min' du deuxième champ de date
        finInput.min = this.value;
        // Vérifie si la date sélectionnée dans le deuxième champ est inférieure à la nouvelle valeur minimale
        if (Date.parse(finInput.value) < Date.parse(this.value)) {
            // Si c'est le cas, réinitialise la valeur du deuxième champ de date
            finInput.value = this.value;
        }
    });
    </script>

<?php require 'Footer.php';?>