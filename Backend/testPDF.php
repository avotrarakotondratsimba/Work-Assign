<?php require 'vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
$html2pdf = new Html2Pdf();

$html_code ='<h1 style="color:red;">This is HTML and CSS .</h1>'; 
$html2pdf->writeHTML($html_code);
// $html2pdf->output();
$fileName = 'test.pdf';
$html2pdf->output($fileName, 'D');
echo "Bonjour";
?>