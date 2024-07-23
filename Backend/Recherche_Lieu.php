<?php
require 'connection.php';

// Vérifier si la variable POST 'recherche' est définie
if(isset($_POST['recherche'])) {
    $recherche = $_POST['recherche'];

    // Construire la requête SQL en fonction de la recherche
    $sql = "SELECT * FROM lieu";
    if (!empty($recherche)) {
        $sql .= " WHERE design LIKE '%" . $recherche . "%' OR province LIKE '%" . $recherche . "%'";
    }

    // Exécuter la requête SQL
    $result = $connect->query($sql);

    // Vérifier si des résultats ont été trouvés
    if ($result->num_rows > 0) {
        // Afficher les résultats
        while($row = $result->fetch_assoc()){
            echo "<tr>";
            echo "<td>" . $row["idlieu"] . "</td>";
            echo "<td>" . $row["design"] . "</td>";
            echo "<td>" . $row["province"] . "</td>";
            echo '<td id="' . $row['idlieu'] . '">
                <div class="action">
                    <div class="edit" id="editer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="editor" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                        </svg>
                    </div>
                    <div class="trash" id="supprimer">
                        <i class="lni lni-trash-can" id="trash"></i>
                    </div>
                </div>
                </td>';
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Aucun résultat trouvé.</td></tr>";
    }
} else {
    echo "Erreur: La variable POST 'recherche' n'est pas définie.";
}
?>
