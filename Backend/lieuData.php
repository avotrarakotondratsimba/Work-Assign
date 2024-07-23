<?php
require 'connection.php';

// Vérifier si l'identifiant du lieu est passé en paramètre
if (isset($_POST['idlieu'])) {
    // Échapper les données pour éviter les injections SQL
    $idlieu = $connect->real_escape_string($_POST['idlieu']);

    // Requête SQL pour récupérer les données du lieu correspondant à l'identifiant
    $sql = "SELECT * FROM lieu WHERE idlieu = '$idlieu'";
    $result = $connect->query($sql);

    // Vérifier s'il y a des résultats
    if ($result->num_rows > 0) {
        // Récupérer les données du lieu
        $row = $result->fetch_assoc();

        // Renvoyer les données au format JSON
        header('Content-Type: application/json');
        echo json_encode($row);
    } else {
        // Si aucun résultat n'est trouvé, renvoyer une réponse vide
        header('Content-Type: application/json');
        echo json_encode(array());
    }
} else {
    // Si l'identifiant du lieu n'est pas passé, renvoyer une réponse vide
    header('Content-Type: application/json');
    echo json_encode(array());
}

// Fermer la connexion à la base de données
$connect->close();
?>
