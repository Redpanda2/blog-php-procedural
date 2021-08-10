<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once "../includes/phpmailer/Exception.php";
require_once "../includes/phpmailer/PHPMailer.php";
require_once "../includes/phpmailer/SMTP.php";

$mail = new PHPMailer(true);

try {
    // Configuration
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;

    // On configure le serveur SMTP 
    $mail->isSMTP();                                    // Set mailer to use SMTP
    $mail->Host = 'localhost';                      // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                             // Enable SMTP authentication
    $mail->Port = 1025;

    // Charset
    $mail->CharSet = 'UTF-8';

    // Destinataires
    $mail->addAddress("test@site.fr");
    $mail->addCC("copie@site.fr");
    $mail->addBCC("copiecachee@site.fr");

    // Expediteur
    $mail->setFrom("no-reply@site.fr");

    // Contenu
    $mail->isHTML(true);
    $mail->Subject = "Sujet du message avec caractères accentués";
    $mail->Body = "Message <div><h1>Titre</h1><p>Contenu du paragraphe</p></div>";

    // Envoi du message
    $mail->send();
    echo "Message envoyé avec succès.";
} catch (Exception) {
    echo "Message non envoyé. Erreur: {$mail->ErrorInfo}";
}




















// $to = "test@site.fr";

// $subject = "Sujet du message";

// $message = "Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.";

// $message = wordwrap($message, 70, "\r\n");

// $headers = [
//     "From" => "no-reply@site.fr",
//     "Reply-To" => "adresse@site.fr",
//     "Cc" => "copie@site.fr",
//     "Bcc" => "copiecachée@site.fr",
//     "Content-Type" => "text/html; charset=utf-8"
// ];

// mail($to, $subject, $message, $headers);
