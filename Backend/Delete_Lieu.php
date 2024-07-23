<?php
require 'connection.php';
// Vérifier si l'identifiant du lieu à supprimer a été envoyé
if(isset($_POST['idlieu'])) {
    $idlieu = $_POST['idlieu'];

    // Requête SQL pour supprimer l'employé de la base de données
    $sql = "DELETE FROM lieu WHERE idlieu = '$idlieu'";
    
    if ($connect->query($sql) === FALSE) {
        echo "Error deleting place: " . $connect->error;
    } 
    
    $connect->close();
}
?>