<?php
require __DIR__.'/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($nom, $prenom, $civilite, $email, $nouveauLieu, $priseService){
    // Créer une instance de PHPMailer
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
        $mail->isSMTP(); //Send using SMTP
        $mail->Host       = 'smtp.gmail.com'; //Set the SMTP server to send through
        $mail->SMTPAuth   = true; //Enable SMTP authentication
        $mail->Username   = 'bytewizard4@gmail.com'; //SMTP username
        $mail->Password   = 'ieoe pgqf qcaa fqkx'; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
        $mail->Port       = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('bytewizard4@gmail.com', 'ByteWizard');
        $mail->addAddress($email, $nom); //Add a recipient

        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = 'Notification d\'affectation';
        if($civilite == 'Mr') $mail->Body = "Cher $prenom $nom,<br><br>";
        else $mail->Body = "Chère $prenom $nom,<br><br>";
        $mail->Body .= "Nous sommes heureux de vous informer que vous avez été affecté à un nouvel emplacement au <br>";
        $mail->Body .= "sein de notre entreprise. Votre nouvelle affectation prendra effet à partir de la date suivante : <br> <br>";
        $mail->Body .= "<ul><li><b>Nouvel Emplacement:<b> $nouveauLieu</li><br>";
        $mail->Body .= "<li><b>Date de Prise de Service:<b> $priseService</li></ul><br><br>";
        $mail->Body .= "Cette affectation reflète notre confiance en votre capacité à contribuer de manière significative à<br>";
        $mail->Body .= "notre équipe dans ce nouveau contexte. Nous sommes convaincus que votre expertise et votre<br>";
        $mail->Body .= "dévouement continueront à enrichir notre environnement de travail.<br><br>";
        $mail->Body .= "Cordialement,<br><br>";
        $mail->Body .= "L'équipe des Ressources Humaines,<br><br>";
        $mail->Body .= "Byte Wizard Company<br><br>";
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>