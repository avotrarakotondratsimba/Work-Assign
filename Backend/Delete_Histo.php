<?php
require 'connection.php';
if(isset($_POST['numAffect'])){
    $numAffect = $_POST['numAffect'];
    $sql = "DELETE FROM affectation WHERE numAffect = '$numAffect'";
    $result = $connect->query($sql);

    if($result == FALSE){
        echo "Une erreur s'est produite lors de la suppression de cette historique: " . $connect->error;
    }
}
?>