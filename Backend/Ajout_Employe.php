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

$sql2 = "INSERT INTO employe VALUES('" . $_POST['numero'] . "', '" . $_POST['civilite'] . "', '" . $_POST['nom'] . "', '" .
        $_POST['prenom'] . "', '" . $_POST['mail'] . "','" . $_POST['poste'] . "', '" . $lieu . "')";

if($connect->query($sql2) == FALSE){
    echo "Erreur : " . $sql2 . "<br>" . $connect->error;
}else {
    header("Location: Employe.php");
    exit();
}