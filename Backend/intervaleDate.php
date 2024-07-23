<?php
require 'connection.php';

if(isset($_POST['debut'], $_POST['fin'])){
    $debut = $_POST['debut'];
    $fin = $_POST['fin'];
    // $sql = "SELECT * FROM affectation WHERE dateAffect BETWEEN '$debut' AND '$fin'";
    $sql = "SELECT a.*, e.nom, e.prenom FROM affectation a JOIN employe e ON a.numEmp = e.numEmp 
            WHERE a.dateAffect BETWEEN '$debut' AND '$fin' ORDER BY numAffect ASC";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["numAffect"] . "</td>";
            echo "<td>" . $row["numEmp"] . "</td>";
            echo "<td>" . $row["nom"] . "</td>";
            echo "<td>" . $row["prenom"] . "</td>";
            echo "<td>" . $row["ancienLieu"] . "</td>";
            echo "<td>" . $row["nouveauLieu"] . "</td>";
            echo "<td>" . $row["dateAffect"] . "</td>";
            echo "<td>" . $row["datePriseService"] . "</td>";
            echo '<td  id="'. $row["numAffect"] . '">
                    <div class="action">
                        <div class="edit" id="edition">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="editor" viewBox="0 0 16 16">
                                <path id="edit" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                            </svg>
                        </div>
                        <div class="trash" id="suppressionHisto">
                            <i class="lni lni-trash-can" id="trash"></i>
                        </div>
                    </div>
                 </td>';
            echo "</tr>";
        }
    } else{
        echo 'Auccun résultat';
    }       
}else{
    echo "Il n'y a pas de données";
}
?>