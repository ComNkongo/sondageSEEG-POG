<?php
// Inclure le fichier PHPMailer
require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

// Configurer Gmail SMTP
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';  // Serveur SMTP de Gmail
$mail->SMTPAuth = true;
$mail->Username = 'comnkongo@gmail.com'; // Ton adresse email Gmail
$mail->Password = '@Lionel26';   // Ton mot de passe Gmail
$mail->SMTPSecure = 'tls';      // Sécuriser la connexion
$mail->Port = 587;              // Port pour TLS

// Informations de l'email
$mail->setFrom('comnkongo@gmail.com', 'Nom de l\'expéditeur');
$mail->addAddress('destination_email@example.com', 'Nom du destinataire'); // Destinataire
$mail->Subject = 'Sujet de l\'email';
$mail->Body    = 'Contenu de l\'email';

if ($mail->send()) {
    echo 'Message envoyé';
} else {
    echo 'Erreur: ' . $mail->ErrorInfo;
}
?>
