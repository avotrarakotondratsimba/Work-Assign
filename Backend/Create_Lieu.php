<?php
require 'connection.php';

// Vérifier si les données POST sont définies
if(isset($_POST['id'], $_POST['designation'], $_POST['province'])) {
    // Échapper les données pour éviter les attaques par injection SQL
    $id = $connect->real_escape_string($_POST['id']);
    $designation = $connect->real_escape_string($_POST['designation']);
    $province = $connect->real_escape_string($_POST['province']);

    $sqlTest = "SELECT * FROM lieu WHERE design = '$designation' AND province = '$province'";
    $result = $connect->query($sqlTest);
    if($result->num_rows == 0){
        // Créer la requête SQL avec les données échappées
        $sql = "INSERT INTO lieu (idlieu, design, province) VALUES ('$id', '$designation', '$province')";

        // Exécuter la requête SQL
        if($connect->query($sql) === TRUE) {
            // // Rediriger vers une page de confirmation ou autre action appropriée
            // header("Location: Lieu.php");
            // exit();
            $response = array("success" => true, "message" => "Ce lieu a été ajouté.");
            echo json_encode($response);
        } else {
            // En cas d'erreur lors de l'exécution de la requête SQL
            echo "Erreur : " . $sql . "<br>" . $connect->error;
        }
    } else {
        // Afficher une SweetAlert en cas de doublon
        $response = array("success" => false, "message" => "Ce lieu existe déjà!");
        echo json_encode($response);
    }

} else {
    // En cas de données POST manquantes
    echo "Tous les champs du formulaire doivent être remplis.";
}

// Fermer la connexion à la base de données
$connect->close();
?>
