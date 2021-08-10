<?php

$to = "test@site.fr";

$subject = "Sujet du message";

$message = "Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.Ceci est un message de test.";

$message = wordwrap($message, 70, "\r\n");

$headers = [
    "From" => "no-reply@site.fr",
    "Reply-To" => "adresse@site.fr",
    "Cc" => "copie@site.fr",
    "Bcc" => "copiecachée@site.fr",
    "Content-Type" => "text/html; charset=utf-8"
];

mail($to, $subject, $message, $headers);
