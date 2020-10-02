<?php

    

require_once 'vendor/autoload.php';
    define('EMAIL' , 'dzekroos@gmail.com');
    define('PASSWORD', 'Thegeniuss98');

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
  ->setUsername(EMAIL)
  ->setPassword(PASSWORD)
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);


    
    function sendVerificationEmail($userEmail,$token){
        $body = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            
            <title>Verification</title>
        </head>
        <body>
            <div class="wrapper">
                <p>
                    Merci de nous rejoindre,clicker sur le lien pour verifier votre email.
        
                </p>
                <a href="http://localhost/ZJ/USER/index2.php?token=' . $token . '">VERIFIER VOTRE EMAIL</a>
            </div>
            
        </body>
        </html>';
        // Create a message
        $message = (new Swift_Message('Verifie votre Email'))
        ->setFrom(EMAIL)
        ->setTo($userEmail)
        ->setBody($body , 'text/html')
        ;

        // Send the message
        $result = $mailer->send($message);


    }

    // function sendPassword(){

    // }

    function sendPasswordResetLink($userEmail,$token){
        global $mailer;

        $body = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            
            <title>Verification</title>
        </head>
        <body>
            <div class="wrapper">
                <p>
                    Bienvenu, pour recupperer le mdp clickez ici!
        
                </p>
                <a href="http://localhost/ZJ/USER/index2.php?password-token=' . $token . '">Recupperer votre mot de passe</a>
            </div>
            
        </body>
        </html>';

        // Create a message
        $message = (new Swift_Message('REcupperation de mdp'))
        ->setFrom(EMAIL)
        ->setTo($userEmail)
        ->setBody($body , 'text/html')
        ;

        // Send the message
        $result = $mailer->send($message);
    }

?>