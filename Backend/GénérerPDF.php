<?php
require __DIR__.'/vendor/autoload.php';


use Spipu\Html2Pdf\Html2Pdf;
function generPDF($nom, $prenom, $civilite, $poste, $ancienLieu, $nouveauLieu, $priseService){
    if($civilite == 'Mr') $participePasse = 'affecté';
    else $participePasse = 'affectée';
    $htmlContent = '
        <style>
            h1 { text-align: center; }
        </style>
        <h1>Arrêté N°2341 du 23/04/2023</h1>
        <p>' . $civilite . ' ' . $nom . ' ' .  $prenom . ', qui occupe le poste de ' . $poste . ' à ' . $ancienLieu . ' est ' . $participePasse . ' à ' . $nouveauLieu . ' pour compter de la date de prise de service ' . $priseService . '.</p>
        <p>Le présent communiqué sera enregistré et communiqué partout où besoin sera.</p>
    ';

    $html2pdf = new Html2Pdf();
    $html2pdf->writeHTML($htmlContent);
    // $html2pdf->output();
    
    //Nom du fichier de sortie
    $fileName = 'Arrete_' . $nom . '_' . $prenom . '.pdf';

    //Forcer le téléchargement du fichier
    $html2pdf->output($fileName, 'D');
}

?>
