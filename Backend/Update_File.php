<?php
require 'connection.php';
$sql1 = "SELECT idlieu FROM lieu WHERE design = '" . $_POST['lieu'] . "'";
$result = $connect->query($sql1);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lieu = $row['idlieu'];
}else{
    echo 'Aucun id correspond à ce lieu';
}

// Requête préparée pour éviter les injections SQL
$sql = 'UPDATE employe SET civilite = ?, nom = ?, prenom = ?, mail = ?, poste = ?, lieu = ? WHERE numemp = ?';
$stmt = $connect->prepare($sql);
$stmt->bind_param('sssssss', $_POST["civilite"], $_POST["nom"], $_POST["prenom"], $_POST["mail"], $_POST["poste"], $lieu, $_POST["numero"]);

if ($stmt->execute()) {
    header("Location: Employe.php");
    exit();
} else {
    echo "Erreur lors de la mise à jour : " . $stmt->error;
}

$stmt->close();