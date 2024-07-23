<?php
echo '<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre titre</title>
    <script src="sweetalert.min.js"></script>
</head>
<body>
    <script>
        Swal.fire({
            title: "Enregistrer!",
            text: "Cette affectation est enregistrée",
            icon: "success"
        }).then(() => {
            // Recharger la page après l\'ajout
            location.reload();
        });
    </script>
</body>
</html>';
// echo "<script>";
// echo 'Swal.fire({
//         title: "Enregistrer!",
//         text: "Cette affectation est enregistrée",
//         icon: "success"
//     }).then(() => {
//         // Recharger la page après l\'ajout
//         location.reload();
//     });';
// echo "</script>";
?>