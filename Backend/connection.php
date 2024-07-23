<?php
$connect = new mysqli("localhost", "root", "", "projetphp");

// Vérifie la connexion
if ($connect->connect_error) {
    die("La connexion a échoué : " . $connect->connect_error);
}
?>