<?php
require 'connection.php';

// Vérifier si l'identifiant de l'employé à supprimer a été envoyé
if(isset($_POST['numEmp'])) {
    $numEmp = $_POST['numEmp'];

    // Requête SQL pour supprimer l'employé de la base de données
    $sql = "DELETE FROM employe WHERE numEmp = '$numEmp'";
    
    if ($connect->query($sql) === FALSE) {
        echo "Error deleting employee: " . $connect->error;
    } 
    
    $connect->close();
}
?>
