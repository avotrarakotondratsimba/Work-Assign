<?php
require 'connection.php';

// Vérifier si les données POST sont définies
if(isset($_POST['designation2']) && isset($_POST['province2'])) {
    // Récupérer les données POST
    $designation = $_POST['designation2'];
    $province = $_POST['province2'];

    // Préparer et exécuter l'instruction SQL
    $sql = "UPDATE lieu SET design='$designation', province='$province' WHERE idlieu = ?"; // Ajoutez votre clause WHERE appropriée
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("s", $_POST['id2']); // Vous devez lier les valeurs pour éviter les injections SQL
    $stmt->execute();

    // Vérifier si la mise à jour a réussi
    if($stmt->affected_rows == 0){
        echo "Aucune modification effectuée.";
    }
} else {
    echo "Erreur: Les données POST ne sont pas définies.";
}
?>
