<?php
require 'connection.php';
if(isset($_POST['numero'])){
    $numeEmp = $_POST['numero'];
    $sql = "SELECT e.nom, e.prenom, l.design FROM employe e JOIN lieu l ON e.lieu = l.idlieu 
            WHERE numemp = '$numeEmp'";
    if($connect->query($sql)->num_rows > 0){
        $row = $connect->query($sql)->fetch_assoc();
        echo json_encode($row);       
    }else {
        // Si aucun résultat n'est trouvé, renvoyer une réponse vide
        echo json_encode(array());
    }

}else {
    // Si aucun résultat n'est trouvé, renvoyer une réponse vide
    echo json_encode(array());
}
?>