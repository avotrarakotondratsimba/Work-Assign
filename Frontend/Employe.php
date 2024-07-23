<?php 
require 'connection.php';
require 'SideBar.php';
require 'Create_Employe.php';
require 'Update_Employe.php';
?>
    <div class="text-center">
        <div id="employeHead">
            <h1 class="titre">
                Employés
            </h1>
            <div class="rechercher">
                <input type="text" placeholder="Rechercher..." id="recherche">
                <i class="lni lni-search-alt" id="search"></i> 
            </div>
        </div>

        <div class="liste">
            <select class="form-select" aria-label="Default select example" name='etatEmploye' id='etatEmploye'>
                <option selected>Tous les employés</option>
                <option>Les employés non affectés</option>
                <option>Les employés qui ont été affectés</option>
            </select>
        </div>

<!---------------------------------------Modal form pour l'ajout de nouveau employé---------------------------> 
        <button type="button" class="btn btn-primary" style="margin-top: 30px; margin-left: 77%" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
            </svg>
        </button>


    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Civilité</th>
                <th>Nom</th>
                <th>Prénom(s)</th>
                <th>Mail</th>
                <th>Poste</th>
                <th>Lieu</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Requête SQL pour sélectionner tous les employés
            $sql = "SELECT e.numEmp, e.civilite, e.nom, e.prenom, e.mail, e.poste, l.design AS lieu FROM employe e
                    JOIN lieu l ON e.lieu=l.idlieu ORDER BY CAST(SUBSTRING(numEmp, 2) AS UNSIGNED) ASC";
            $result = $connect->query($sql);

            // Vérifie s'il y a des résultats
            if ($result->num_rows > 0) {
                // Affiche les données dans le tableau
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["numEmp"] . "</td>";
                    echo "<td>" . $row["civilite"] . "</td>";
                    echo "<td>" . $row["nom"] . "</td>";
                    echo "<td>" . $row["prenom"] . "</td>";
                    echo "<td>" . $row["mail"] . "</td>";
                    echo "<td>" . $row["poste"] . "</td>";
                    echo "<td>" . $row["lieu"] . "</td>";
                    echo '<td  id="'. $row["numEmp"] . '">
                          <div class="action">
                            <div class="edit" id="edition">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="editor" viewBox="0 0 16 16">
                                    <path id="edit" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                </svg>
                            </div>
                            <div class="trash" id="suppression">
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

<!-----------------------------Pour faire la recherche par nom ou prénom des employés------------------------->
<script>
    $(document).ready(function(){
        $('#recherche').on('input', function() {
            var recherche = $(this).val();
            var etat = $('#etatEmploye').val();
            console.log(etat);
            $.ajax({
                type: 'POST',
                url: 'Recherche_Employe.php',
                data: { recherche: recherche, etat: etat },
                success: function(data) {
                    $('#myTable tbody').html(data); // Mettre à jour le contenu du corps de la table
                }
            });
        });
    

        //-----------------------------------------Update Employés----------------------------------------------------

        // Récupérer les données de l'employé à mettre à jour
        $(document).on('click', '.edit', function() {
            // Récupérer l'identifiant de l'employé à partir de l'icône d'édition
            var numEmp = $(this).closest('td').attr('id');
            console.log(numEmp); 
            
            // Effectuer une requête AJAX pour récupérer les données de l'employé
            $.ajax({
                type: 'GET',
                url: 'employeData.php?numEmp=' + numEmp, // URL du script PHP pour récupérer les données de l'employé
                dataType: 'json',
                success: function(response) {
                    // Remplir les champs du formulaire avec les données de l'employé
                    console.log(response);
                    $('#numero2').val(response.numemp);
                    $('#civilite2').val(response.civilite);
                    $('#nom2').val(response.nom);
                    $('#prenom2').val(response.prenom);
                    $('#mail2').val(response.mail);
                    $('#poste2').val(response.poste);
                    $('#lieu2').val(response.lieu);
                    
                    // Afficher la fenêtre modale de mise à jour
                    $('#update').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Afficher un message d'erreur en cas d'échec de la requête AJAX
                    alert('Une erreur s\'est produite lors de la récupération des données de l\'employé.');
                }
            });
        });

    
    //------------------------Mis à jour du tableau selon le critère sélectionné---------------------------//
        // Écouteur d'événement pour le changement de sélection dans la liste déroulante
        $('#etatEmploye').change(function(){
            // Récupérer la valeur de l'élément sélectionné dans la liste déroulante
            var selectedValue = $(this).val();
            
            // Effectuer la requête Ajax
            $.ajax({
            url: 'critereEmploye.php',
            method: 'POST', // Méthode HTTP à utiliser, POST dans cet exemple
            data: { selectedValue: selectedValue }, // Les données à envoyer au serveur
            success: function(data){
                $('#myTable tbody').html(data); // Mettre à jour le contenu du corps de la table
            },
            error: function(xhr, status, error){
                // Callback en cas d'erreur
                console.error('Erreur lors de l\'envoi de la requête :', error);
            }
            });
        });
        
    });
</script>
<?php require 'Footer.php';?>