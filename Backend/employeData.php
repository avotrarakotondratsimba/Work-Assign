<?php
// Connexion à la base de données
require 'connection.php';

// Vérifier si l'identifiant de l'utilisateur est passé en paramètre
if (isset($_GET['numEmp'])) {
    // Échapper les données pour éviter les injections SQL
    $numEmp = $connect->real_escape_string($_GET['numEmp']);

    // Requête SQL pour récupérer les données de l'utilisateur correspondant à l'identifiant
    $sql = "SELECT e.numemp, e.civilite, e.nom, e.prenom, e.mail, e.poste, l.design AS lieu FROM employe e
            JOIN lieu l ON e.lieu=l.idlieu WHERE numEmp = '$numEmp'";
    $result = $connect->query($sql);

    // Vérifier s'il y a des résultats
    if ($result->num_rows > 0) {
        // Récupérer les données de l'utilisateur
        $row = $result->fetch_assoc();

        // Renvoyer les données au format JSON
        echo json_encode($row);
    } else {
        // Si aucun résultat n'est trouvé, renvoyer une réponse vide
        echo json_encode(array());
    }
} else {
    // Si l'identifiant de l'utilisateur n'est pas passé, renvoyer une réponse vide
    echo json_encode(array());
}
?>
