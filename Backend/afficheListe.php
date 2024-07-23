<?php
require 'connection.php';

if (isset($_POST['ancienLieu'])) {
    $ancienLieu = $_POST['ancienLieu'];
    $sql = "SELECT design FROM lieu WHERE design <> '$ancienLieu'";
    $result = $connect->query($sql);
    
    $options = array(); // Initialiser un tableau pour stocker les options
    $options[] = "Nouveau lieu";
    
    if ($result->num_rows > 0) {
        // Parcourir toutes les lignes de résultats
        while ($row = $result->fetch_assoc()) {
            // Ajouter chaque design à la liste d'options
            $options[] = $row['design'];
        }
    }
    
    // Envoyer les options en tant que réponse JSON
    echo json_encode($options);
} else {
    // Si aucun résultat n'est trouvé, renvoyer une réponse vide
    echo json_encode(array());
}
?>
