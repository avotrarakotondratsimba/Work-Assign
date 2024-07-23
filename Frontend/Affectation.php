<?php require 'connection.php';?>
<?php require 'SideBar.php';?>
<div class="text-center">
    <h1>Affectation</h1>
</div>

<div class="container">
    <div class="affectation">   


        <form class="affectForm" action = 'Enregistrement_Affect.php' method = 'POST'>

            <?php
                $sql = "SELECT numaffect FROM affectation ORDER BY numaffect DESC limit 1";
                $result = $connect->query($sql);
                if($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    $i = $row['numaffect'] + 1;
                }else{
                    $i = 1;
                }
                echo "<h3 class = 'titreAffect'>N° d'affectation: <input id ='num' name='num' readonly value='" . $i . "'></h3> ";
            ?>

            <input class="form-control" name='affectNum' id='affectNum' type="text" placeholder="Numéro" aria-label="default input example">
            
            <div class="a">
                <div id="nom1" class='gauche'>
                    <input class="form-control" name='nomAffect' id='nomAffect' type="text" placeholder="Nom" aria-label="default input example">
                </div>
                <div class="prenom1">
                  <input class="form-control" name='prenomAffect' id='prenomAffect' type="text" placeholder="Prénom(s)" aria-label="default input example">
                </div>
            </div>
            <div class="b">
                <div id="ancienLieu1" class='gauche'>
                    <input class="form-control" name='ancienLieu' id='ancienLieu' type="text" readonly placeholder="Ancien lieu" aria-label="default input example">
                </div>
                <div class="nouveauLieu1">
                 <!--   <label for="nouveauLieu">Nouveau Lieu</label> <br> -->
                    <select class="form-select" aria-label="Default select example" name='nouveauLieu' id='nouveauLieu'>
                            <option selected>Nouveau lieu</option>
                            
                            <!-- <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option> -->
                    </select>
                </div>
            </div> <br> 
            <div class="a">
                <div id="dateAffect1" class='site'>
                    <label for="dateAffect">Date d'affectation</label><br>
                    <input class="form-control 2" name='dateAffect' id='dateAffect' type="date" aria-label="default input example">
                </div>
                <div class="datePriseService1">
                    <label for="datePriseService">Date de prise de service</label> <br>
                    <input class="form-control 2" name='datePriseService' id='datePriseService' type="date" aria-label="default input example">
                </div>
            </div>
            <div class="btnAffect">
                <button type='sumit' id='affectBtn'>Enregistrer</button>
            </div>
        </form>
    </div>
</div>
<?php require 'Footer.php';?>

<script>
    // Pour afficher automatiquement le nom, le prénom(s) ainsi que l'ancien lieu lors de la saisit du numEmp
    $(document).ready(function(){
        $('#affectNum').on('input', function() {
            var numero = $(this).val();
            console.log(numero);
            $.ajax({
                type: 'POST',
                url: 'Details_Employe.php',
                data: { numero: numero },
                success: function(data) {
                    // Analyser les données JSON reçues
                    var detailsEmploye = JSON.parse(data);
                    console.log(detailsEmploye);
                    $('#nomAffect').val(detailsEmploye.nom);
                    $('#prenomAffect').val(detailsEmploye.prenom);
                    $('#ancienLieu').val(detailsEmploye.design);
                    //Remplissage de la liste déroulante du nouveau lieu
                    var ancienLieuValue = $('#ancienLieu').val();
                    console.log(ancienLieuValue);
                    $.ajax({
                        type: 'POST',
                        url: 'afficheListe.php',
                        data: { ancienLieu: ancienLieuValue },
                        success: function(data) {
                            // Effacez le contenu actuel de la liste déroulante
                            $('#nouveauLieu').empty();
                            // Analyser les données JSON reçues
                            var options = JSON.parse(data);
                            console.log(options);
                
                            // Ajouter les autres options à la liste déroulante
                            options.forEach(function(option) {
                                $('#nouveauLieu').append($('<option>', {
                                    value: option,
                                    text: option
                                }));
                            });
                        },
                        error: function() {
                            console.log('Erreur lors de la récupération des données.');
                        }
                    });
                }
            });
        });
    });
    

    //Enregistrement de l'affectation
    // $(document).ready(function(){
    //     $('#affectBtn').on('click', function() {
    //         // Empêcher le formulaire de se soumettre de manière traditionnelle
    //         event.preventDefault();

    //         // Collecter les données du formulaire
    //         var formData = $('.affectForm').serialize();

    //         // Envoyer les données au script PHP
    //         $.ajax({
    //             type: 'POST',
    //             url: 'Enregistrement_Affect.php',
    //             data: formData, // Envoyer les données du formulaire
    //             success: function(response){
    //                 // Afficher une boîte de dialogue de succès
    //                 console.log(response);
    //                 Swal.fire({
    //                     title: "Enregistrer!",
    //                     text: "Cette affectation est enregistrée",
    //                     icon: "success"
    //                 }).then(() => {
    //                     // Recharger la page après l'ajout
    //                     location.reload();
    //                 });
    //             }
    //         });
    //     });
    // });

</script>