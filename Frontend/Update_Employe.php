
<div class="modal fade" data-bs-backdrop="static" id="update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Mise à jour</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <form action="Update_File.php" method="POST">
                        <div class="mb-3">
                            <label for="numero">Numéro</label> <br>
                            <input type="text" id="numero2" name="numero" readonly> 
                                <label for="civilite">Civilité :</label>
                                <select id="civilite2" name="civilite">
                                    <option value="Mr">Mr</option>
                                    <option value="Mme">Mme</option>
                                    <option value="Mlle">Mlle</option>
                                </select> <br> <br>
                                <label for="nom">Nom</label> <br>
                                <input type="text" name="nom" id="nom2" required> <br> <br>
                                <label for="prenom">Prénom(s)</label> <br> 
                                <input type="text" name="prenom" id="prenom2" required> <br> <br>
                                <label for="mail">Mail</label> <br> 
                                <input type="mail" name="mail" id="mail2" required> <br> <br>
                                <label for="poste">Poste</label> <br> 
                                <input type="text" name="poste" id="poste2" required> <br> <br>
                                <label for="lieu">Lieu :</label>
                                <select id="lieu2" name="lieu">
                                    <?php
                                        $sql = "SELECT design FROM lieu";
                                        $result = $connect->query($sql);
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                echo '<option value="' . $row["design"] . '">' . $row["design"] . '</option>';
                                            }
                                        }
                                    ?>
                                </select> <br> <br>              
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary" id="enregistrer2">Enregistrer</button>
                            </div>
                        </div>  
                    </form>
                    </div>
                    </div>
                </div>
            </div> 

<!----------------------------- Vérification de la conforrmité des données entrées --------------------------->
<script>
    const nomInput2 = document.getElementById('nom2');
    const prenomInput2 = document.getElementById('prenom2');
    const emailInput2 = document.getElementById('mail2');
    const posteInput2 = document.getElementById('poste2');
    const enregistrerBtn2 = document.getElementById('enregistrer2');
    
    function validateEmail2(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }
    
    function checkInputs2() {
        const nomValue2 = nomInput2.value.trim();
        const prenomValue2 = prenomInput2.value.trim();
        const emailValue2 = emailInput2.value.trim();
        const posteValue2 = posteInput2.value.trim();
        
        const isValid2 = nomValue2 !== '' && prenomValue2 !== '' && emailValue2 !== '' && posteValue2 !== '' && validateEmail2(emailValue2);
        
        if (isValid2) {
            enregistrerBtn2.removeAttribute('disabled');
        } else {
            enregistrerBtn2.setAttribute('disabled', 'true');
        }
    }
    
    nomInput2.addEventListener('input', checkInputs2);
    prenomInput2.addEventListener('input', checkInputs2);
    emailInput2.addEventListener('input', checkInputs2);
    posteInput2.addEventListener('input', checkInputs2);
</script>
