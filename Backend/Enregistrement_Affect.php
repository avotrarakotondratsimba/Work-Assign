<?php
require 'connection.php';
require 'GénérerPDF.php';
require 'testmail.php';

// Traitement du formulaire d'enregistrement de l'affectation d'employé
if (isset($_POST['affectNum'], $_POST['nomAffect'], $_POST['prenomAffect'], $_POST['ancienLieu'], $_POST['nouveauLieu'], $_POST['dateAffect'], $_POST['datePriseService'], $_POST['num'])) {
    
    // Récupération des données du formulaire
    $numero = $_POST['affectNum'];
    $nom = $_POST["nomAffect"];
    $prenom = $_POST["prenomAffect"];
    $ancienLieu = $_POST["ancienLieu"];
    $nouveauLieu = $_POST["nouveauLieu"];
    $dateAffect = $_POST['dateAffect'];
    $priseService = $_POST['datePriseService'];

    //Récupération de la civilité, de l'adresse email et du poste
    $sql1 = "SELECT civilite, mail, poste FROM employe WHERE numemp = '$numero'";
    $result1 = $connect->query($sql1);
    if ($result1->num_rows > 0) {
        $row1 = $result1->fetch_assoc();
        $email = $row1['mail'];
        $civilite = $row1['civilite'];
        $poste = $row1['poste'];
    }
    
    //Générer PDF
    generPDF($nom, $prenom, $civilite, $poste, $ancienLieu, $nouveauLieu, $priseService);

    //Notification par email
    sendMail($nom, $prenom, $civilite, $email, $nouveauLieu, $priseService);

    $i = $_POST['num'];
    //Enregistrement dans la base de données
    $sql2 = "INSERT INTO affectation (numAffect, numEmp, ancienLieu, nouveauLieu, dateAffect, datePriseService)
             VALUES($i, '$numero','$ancienLieu', '$nouveauLieu', '$dateAffect','$priseService')";
    $result2 = $connect->query($sql2);
    if($result2 === FALSE) {
        // En cas d'erreur lors de l'exécution de la requête SQL
        echo "Erreur : " . $sql2 . "<br>" . $connect->error;
    }

    //Faire un update sur le nouvel emplacement de l'employé
    $sqlLieu = "SELECT idlieu FROM lieu WHERE design = '$nouveauLieu'";
    $resultat = $connect->query($sqlLieu);
    if($resultat->num_rows > 0){
        $rowLieu = $resultat->fetch_assoc();
        $idlieu = $rowLieu['idlieu'];
    }
    $sql3 = "UPDATE employe SET lieu = '$idlieu' WHERE numEmp = '$numero'";
    $result3 = $connect->query($sql3);
    if($result3 === TRUE) {
        header("Location: Affectation.php");
        // header("Location: Affectation.php");
        // // Afficher l'alerte de succès
        // echo '<script src="sweetalert.min.js"></script>';
        // // Afficher un SweetAlert pour confirmer le succès
        // echo '<script>';
        // echo 'Swal.fire({
        //         title: "Succès!",
        //         text: "Cette affectation est enregistrée",
        //         icon: "success"
        //     }).then(() => {
        //         // Rediriger vers la page Affectation.php
        //         window.location.href = "Affectation.php";
        //     });';
        // echo '</script>';
    } else {
        // En cas d'erreur lors de l'exécution de la requête SQL
        echo "Erreur : " . $sql3 . "<br>" . $connect->error;
    }
    
}else {
    echo 'Rien n\'est capruré';
}
?>
