<div class="modal fade" data-bs-backdrop="static" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajout d'employé</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="Ajout_Employe.php" method="POST">
                            <div class="mb-3">
                                <label for="numero">Numéro</label> <br>
                                <?php
                                    $sql = "SELECT SUBSTRING(numEmp, 2) AS last_num FROM employe ORDER BY CAST(SUBSTRING(numEmp, 2) AS UNSIGNED) DESC LIMIT 1";
                                    $result2 = $connect->query($sql);
                                    
                                    if ($result2->num_rows > 0) {
                                        $row = $result2->fetch_assoc();
                                        $i = $row['last_num'] + 1;
                                    }else{
                                        $i = 1;
                                    }
                                    echo '<input type="text" name="numero" id="numero" value="E' . $i . '" readonly> <br> <br>'
                                ?>
                                <label for="civilite">Civilité :</label>
                                <select id="civilite" name="civilite">
                                    <option value="Mr">Mr</option>
                                    <option value="Mme">Mme</option>
                                    <option value="Mlle">Mlle</option>
                                </select> <br> <br>
                                <label for="nom">Nom</label> <br>
                                <input type="text" name="nom" id="nom" required> <br> <br>
                                <label for="prenom">Prénom(s)</label> <br> 
                                <input type="text" name="prenom" id="prenom" required> <br> <br>
                                <label for="mail">Mail</label> <br> 
                                <input type="mail" name="mail" id="mail" required> <br> <br>
                                <label for="poste">Poste</label> <br> 
                                <input type="text" name="poste" id="poste" required> <br> <br>
                                <label for="lieu">Lieu :</label>
                                <select id="lieu" name="lieu">
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
                                    <button type="submit" class="btn btn-primary" id="enregistrer" disabled>Enregistrer</button>
                                </div>
                            </div>  
                        </form>
                    </div>
                    </div>
                </div>
            </div>   
 
<!----------------------------- Vérification de la conforrmité des données entrées --------------------------->
<script>
    const nomInput = document.getElementById('nom');
    const prenomInput = document.getElementById('prenom');
    const emailInput = document.getElementById('mail');
    const posteInput = document.getElementById('poste');
    const enregistrerBtn = document.getElementById('enregistrer');
    
    function validateEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }
    
    function checkInputs() {
        const nomValue = nomInput.value.trim();
        const prenomValue = prenomInput.value.trim();
        const emailValue = emailInput.value.trim();
        const posteValue = posteInput.value.trim();
        
        const isValid = nomValue !== '' && prenomValue !== '' && emailValue !== '' && posteValue !== '' && validateEmail(emailValue);
        
        if (isValid) {
            enregistrerBtn.removeAttribute('disabled');
        } else {
            enregistrerBtn.setAttribute('disabled', 'true');
        }
    }
    
    nomInput.addEventListener('input', checkInputs);
    prenomInput.addEventListener('input', checkInputs);
    emailInput.addEventListener('input', checkInputs);
    posteInput.addEventListener('input', checkInputs);
</script>